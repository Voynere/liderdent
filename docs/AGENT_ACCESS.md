# Доступы для агента (liderdent24.ru)

Документ **не хранит пароли**. Чеклист, чтобы агент не просил пароли и не падал на «sensitive input required».

## SSH prod

| Параметр | Значение |
|----------|----------|
| Alias | **`mrtlider`** (в `~/.ssh/config`) |
| Host | `37.46.132.136` |
| User | `root` |
| Site path | `/var/www/liderdent/data/www/liderdent24.ru` |
| Theme path | `.../wp-content/themes/dental` |

### Проверка (агент выполняет сам)

```bash
ssh -o BatchMode=yes mrtlider "echo ok"
ssh -o BatchMode=yes mrtlider "ls -la /var/www/liderdent/data/www/liderdent24.ru/wp-content/themes/dental/functions.php"
curl -sS -o /dev/null -w "%{http_code}\n" https://liderdent24.ru/
```

**Запрещено агенту:** `ssh root@37.46.132.136` без alias (вызовет password prompt).

## GitHub Actions deploy

- Workflow: `.github/workflows/deploy.yml`
- Secrets: `SERVER_HOST`, `SERVER_USER`, `SERVER_PORT`, `SERVER_SSH_KEY`, `SERVER_PATH`
- Push в `main` → rsync темы `dental` на прод, backup в `/tmp/liderdent-deploy-backups/`

Проверка после push:

```bash
gh run list --workflow=deploy.yml --limit 3 --repo Voynere/liderdent
gh run view <id> --log-failed --repo Voynere/liderdent
```

Ручной запуск:

```bash
gh workflow run deploy.yml --repo Voynere/liderdent
```

## WP-CLI на сервере

Deploy workflow выполняет `wp plugin update --all` и flush cache после rsync.

## Локальная копия

- Полный WordPress локально; в git только `wp-content/themes/dental/`, `scripts/`, `docs/`, `.github/`
- `wp-config.php`, плагины, uploads — только локально / на сервере
