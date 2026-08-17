#!/usr/bin/env php
<?php
/**
 * Create JS reachGoal targets on Yandex Metrika counter 106770436.
 * Never prints token values.
 *
 *   php create-metrika-goals.php --env=/path/to/yandex-direct.env --apply
 *   php create-metrika-goals.php --env=/path/to/yandex-direct.env --dry-run
 */

declare(strict_types=1);

const DEFAULT_COUNTER = 106770436;

/** @var list<array{key:string,name:string}> */
const GOALS = [
    ['key' => 'form_open', 'name' => 'Открытие попапа записи'],
    ['key' => 'form_start', 'name' => 'Начало заполнения формы'],
    ['key' => 'form_submit_success', 'name' => 'Успешная заявка'],
    ['key' => 'form_submit_error', 'name' => 'Ошибка отправки формы'],
];

const TOKEN_KEYS = [
    'METRIKA_OAUTH_TOKEN',
    'METRIKA_TOKEN',
    'TOKEN_LIDER_MRT',
    'TOKEN_SIBERIA_LIDER_MRT',
    'TOKEN_ZAPAD_LIDER_MRT',
];

$apply = in_array('--apply', $argv ?? [], true);
$envPath = '';
$counter = DEFAULT_COUNTER;

foreach ($argv ?? [] as $i => $arg) {
    if ($i === 0) {
        continue;
    }
    if (str_starts_with($arg, '--env=')) {
        $envPath = substr($arg, 6);
    } elseif ($arg === '--env' && isset($argv[$i + 1])) {
        $envPath = (string) $argv[$i + 1];
    } elseif (str_starts_with($arg, '--counter=')) {
        $counter = (int) substr($arg, 10);
    }
}

if ($envPath === '' || !is_readable($envPath)) {
    fwrite(STDERR, "ERROR: readable --env=file required\n");
    exit(1);
}

$env = [];
foreach (file($envPath, FILE_IGNORE_NEW_LINES) ?: [] as $line) {
    $line = trim($line);
    if ($line === '' || str_starts_with($line, '#')) {
        continue;
    }
    if (!str_contains($line, '=')) {
        continue;
    }
    [$k, $v] = explode('=', $line, 2);
    $env[trim($k)] = trim($v, " \t\"'");
}

$candidates = [];
foreach (TOKEN_KEYS as $key) {
    $t = trim((string) ($env[$key] ?? ''));
    if ($t !== '') {
        $candidates[$key] = $t;
    }
}
if ($candidates === []) {
    fwrite(STDERR, "ERROR: no Metrika/Direct OAuth keys in env file\n");
    exit(1);
}

/**
 * @return array{ok:bool,code:int,body:string,json:?array}
 */
function metrikaRequest(string $method, string $url, string $token, ?array $payload = null): array
{
    $ch = curl_init($url);
    $headers = [
        'Authorization: OAuth ' . $token,
        'Content-Type: application/json',
        'Accept: application/json',
    ];
    $opts = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_TIMEOUT => 60,
    ];
    if ($payload !== null) {
        $opts[CURLOPT_POSTFIELDS] = json_encode($payload, JSON_UNESCAPED_UNICODE);
    }
    curl_setopt_array($ch, $opts);
    $body = (string) curl_exec($ch);
    $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err = curl_error($ch);
    curl_close($ch);
    if ($err !== '') {
        return ['ok' => false, 'code' => 0, 'body' => $err, 'json' => null];
    }
    $json = json_decode($body, true);
    return [
        'ok' => $code >= 200 && $code < 300,
        'code' => $code,
        'body' => $body,
        'json' => is_array($json) ? $json : null,
    ];
}

echo 'create-metrika-goals ' . ($apply ? 'APPLY' : 'dry-run') . "\n";
echo 'Counter: ' . $counter . "\n";

$token = '';
$tokenSource = '';
$list = null;
foreach ($candidates as $key => $t) {
    echo "Trying {$key}… ";
    $probe = metrikaRequest(
        'GET',
        'https://api-metrika.yandex.net/management/v1/counter/' . $counter . '/goals',
        $t
    );
    if ($probe['ok']) {
        echo "OK\n";
        $token = $t;
        $tokenSource = $key;
        $list = $probe;
        break;
    }
    echo "HTTP {$probe['code']}\n";
}

if ($token === '' || $list === null) {
    fwrite(STDERR, "ERROR: no token can read counter {$counter} (need metrika:read + metrika:write)\n");
    exit(1);
}
echo "Using token from {$tokenSource}\n\n";

$existingByIdent = [];
$existingByName = [];
foreach ($list['json']['goals'] ?? [] as $g) {
    if (!is_array($g)) {
        continue;
    }
    $id = (int) ($g['id'] ?? 0);
    $name = (string) ($g['name'] ?? '');
    $type = (string) ($g['type'] ?? '');
    $idents = [];
    foreach ($g['conditions'] ?? [] as $cond) {
        if (!is_array($cond)) {
            continue;
        }
        $u = trim((string) ($cond['url'] ?? ''));
        if ($u !== '') {
            $idents[] = $u;
        }
    }
    echo "EXIST id={$id} type={$type} name={$name} idents=[" . implode(',', $idents) . "]\n";
    foreach ($idents as $ident) {
        $existingByIdent[mb_strtolower($ident)] = $id;
    }
    $existingByName[mb_strtolower($name)] = $id;
}

echo "\n";

$created = 0;
$skipped = 0;
$failed = 0;
$ids = [];

foreach (GOALS as $spec) {
    $key = $spec['key'];
    $keyLower = mb_strtolower($key);
    if (isset($existingByIdent[$keyLower])) {
        $ids[$key] = $existingByIdent[$keyLower];
        echo "SKIP {$key} — already exists as goal id={$existingByIdent[$keyLower]}\n";
        $skipped++;
        continue;
    }
    if (isset($existingByName[mb_strtolower($spec['name'])])) {
        $ids[$key] = $existingByName[mb_strtolower($spec['name'])];
        echo "SKIP {$key} — name already exists id={$existingByName[mb_strtolower($spec['name'])]}\n";
        $skipped++;
        continue;
    }

    $payload = [
        'goal' => [
            'name' => $spec['name'],
            'type' => 'action',
            'conditions' => [
                [
                    'type' => 'exact',
                    'url' => $key,
                ],
            ],
        ],
    ];

    echo ($apply ? 'CREATE' : 'WOULD CREATE') . " {$key} — {$spec['name']}\n";
    if (!$apply) {
        continue;
    }

    $res = metrikaRequest(
        'POST',
        'https://api-metrika.yandex.net/management/v1/counter/' . $counter . '/goals',
        $token,
        $payload
    );
    if (!$res['ok']) {
        echo "  ERROR HTTP {$res['code']}\n";
        $failed++;
        continue;
    }
    $newId = (int) ($res['json']['goal']['id'] ?? 0);
    echo "  OK id={$newId}\n";
    $created++;
    if ($newId > 0) {
        $existingByIdent[$keyLower] = $newId;
        $ids[$key] = $newId;
    }
}

echo "\nSummary: created={$created} skipped={$skipped} failed={$failed}\n";

$final = metrikaRequest(
    'GET',
    'https://api-metrika.yandex.net/management/v1/counter/' . $counter . '/goals',
    $token
);
if (!$final['ok']) {
    fwrite(STDERR, "ERROR: final GET failed HTTP {$final['code']}\n");
    exit(1);
}

echo "\n## Goals now (counter {$counter})\n";
echo "identifier\tname\tgoal_id\n";
foreach (GOALS as $spec) {
    $key = $spec['key'];
    $foundId = $ids[$key] ?? 0;
    if ($foundId === 0) {
        foreach ($final['json']['goals'] ?? [] as $g) {
            foreach ($g['conditions'] ?? [] as $cond) {
                if (mb_strtolower(trim((string) ($cond['url'] ?? ''))) === mb_strtolower($key)) {
                    $foundId = (int) ($g['id'] ?? 0);
                }
            }
        }
    }
    echo $key . "\t" . $spec['name'] . "\t" . ($foundId > 0 ? (string) $foundId : 'MISSING') . "\n";
}

if ($failed > 0) {
    exit(1);
}
exit(0);
