# Yandex Metrika Search Phrases

> Поисковые фразы из Яндекс.Метрики для SEO-анализа

## Зависимости

⚠️ Требует установленный [yandex-metrika-core](https://github.com/prikotov/yandex-metrika-core)

## Установка

```bash
# Сначала установите core
git clone https://github.com/prikotov/yandex-metrika-core.git .opencode/skills/yandex-metrika-core

# Затем этот skill
git clone https://github.com/prikotov/yandex-metrika-search.git .opencode/skills/yandex-metrika-search
```

## Использование

```bash
php .opencode/skills/yandex-metrika-search/metrika.php                    # последние 30 дней
php .opencode/skills/yandex-metrika-search/metrika.php 2026-01-01 2026-02-28
```

## Результаты

```
metrika_reports/
└── 2026-03-02_10-30-15/
    ├── metrika_phrases.csv
    ├── metrika_phrases.md
    ├── metrika_phrases_pages.csv
    └── metrika_phrases_pages.md
```

---

Постановка задач, архитектура, ревью — [**Dmitry Prikotov**](https://prikotov.pro/)
Реализация — [OpenCode](https://opencode.ai) + GLM-5
