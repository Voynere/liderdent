# Liderdent Custom Code

Репозиторий кастомного кода для [liderdent24.ru](https://liderdent24.ru) — только то, что поддерживается вручную.

## Что входит в репозиторий

- `wp-content/themes/dental/`

## Что не входит

- Ядро WordPress (`wp-admin/`, `wp-includes/`, корневые `wp-*.php`)
- Сторонние плагины (ACF, AIOSEO, Contact Form 7 и др.)
- `wp-config.php`, `.htaccess`
- uploads, cache, backups, logs
- сгенерированные файлы (`llms.txt` и т.п.)

## Модель деплоя

GitHub Actions загружает только кастомные пути и синхронизирует их в живое дерево WordPress на сервере. Сервер хранит ядро WP, плагины, медиа и кэш вне git.

Секреты GitHub:

- `SERVER_HOST`
- `SERVER_USER`
- `SERVER_PORT`
- `SERVER_SSH_KEY`
- `SERVER_PATH`

## Локальная полная копия

Полный сайт (для разработки и отладки) лежит отдельно в `~/Projects/liderdent/` и не пушится в этот репозиторий.
