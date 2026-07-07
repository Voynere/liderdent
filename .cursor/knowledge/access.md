# Access and ops

## Quick checks

```bash
ssh -o BatchMode=yes mrtlider "echo ok"
curl -sS -o /dev/null -w "%{http_code}\n" https://liderdent24.ru/
gh run list --workflow=deploy.yml --limit 1 --repo Voynere/liderdent
```

## Key docs

| Topic | File |
|-------|------|
| Full access checklist | `docs/AGENT_ACCESS.md` |
| Custom code scope | `docs/CUSTOM_SCOPE.md` |
| Work plan | `seov/plan.md` (локально) |
| Theme map | `.cursor/knowledge/theme.md` |

## Dev workflow

- Commit → push `main` → green `deploy.yml` (`.cursor/rules/dev-commit-push-ci.mdc`)
