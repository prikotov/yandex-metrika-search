---
name: yandex-metrika-search
description: Поисковые фразы из Яндекс.Метрики для SEO-анализа
license: MIT
compatibility: opencode
---

## Когда использовать

- Анализ поискового трафика
- Поиск популярных запросов
- Определение страниц с высокими отказами

## Запуск

Выполнять из корня проекта:

```bash
php .opencode/skills/yandex-metrika-search/metrika.php [дата_от] [дата_до]
```

## Результат

`metrika_reports/YYYY-MM-DD_HH-MM-SS/`:
- `metrika_phrases.csv` / `.md` — фразы с метриками
- `metrika_phrases_pages.csv` / `.md` — фразы + страницы входа
