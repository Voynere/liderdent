---
name: agent-memory
description: >-
  Search and update liderdent RAG memory (dental theme, deploy, forms, specialists).
  Use when starting work on liderdent24.ru, when context from past sessions is needed,
  or when saving decisions for future agents.
---

# Agent Memory (liderdent)

## Query memory

```bash
python3 .cursor/rag/rag.py query "popup form ajax"
python3 .cursor/rag/rag.py query "SSH deploy liderdent"
python3 .cursor/rag/rag.py query "specialist CPT"
```

## Save to memory

```bash
python3 .cursor/rag/rag.py remember "Описание решения" --tag deploy
```

## Rebuild index

```bash
python3 .cursor/rag/rag.py index
python3 .cursor/rag/rag.py status
```

## Sources

- `.cursor/memory/` — факты проекта
- `.cursor/knowledge/` — тема, доступы
- `docs/` — AGENT_ACCESS, CUSTOM_SCOPE
- `seov/` — план, отчёты (локально, gitignore)

See also [agent-memory rule](../rules/agent-memory.mdc).
