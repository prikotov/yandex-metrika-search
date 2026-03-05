---
name: yandex-metrika-search
description: Поисковые фразы из Яндекс.Метрики для SEO-анализа
---

## Когда использовать

- Анализ поискового трафика
- Поиск популярных запросов
- Определение фраз с высокими отказами

## Запуск

```bash
php .opencode/skills/yandex-metrika-search/metrika.php [опции] [дата_от] [дата_до]
```

### Параметры дат

- `дата_от` — начало периода (формат: YYYY-MM-DD), по умолчанию 30 дней назад
- `дата_до` — конец периода (формат: YYYY-MM-DD), по умолчанию сегодня

### Опции

| Опция | Сокращение | Описание | Значения | По умолчанию |
|-------|------------|----------|----------|--------------|
| `--sort` | `-s` | Поле сортировки | `visits`, `visitors`, `bounce_rate`, `page_depth`, `avg_duration` | `visits` |
| `--order` | `-o` | Направление сортировки | `asc`, `desc` | `desc` |
| `--limit` | `-l` | Лимит записей | число (например: 10, 20, 50) | все записи |

### Примеры

```bash
# Все фразы за 30 дней, сортировка по визитам (по убыванию)
php .opencode/skills/yandex-metrika-search/metrika.php

# Топ-10 фраз по визитам
php .opencode/skills/yandex-metrika-search/metrika.php --limit 10

# Топ-20 фраз с наибольшим процентом отказов
php .opencode/skills/yandex-metrika-search/metrika.php -s bounce_rate -l 20

# Топ-15 фраз по времени на сайте (по возрастанию — худшие)
php .opencode/skills/yandex-metrika-search/metrika.php --sort avg_duration --order asc --limit 15

# За определённый период
php .opencode/skills/yandex-metrika-search/metrika.php -l 10 2025-01-01 2025-01-31

# Все фразы, сортировка по глубине просмотра
php .opencode/skills/yandex-metrika-search/metrika.php -s page_depth
```

## Результат

`yandex_metrika_reports/YYYY-MM-DD/`:
- `metrika_phrases_YYYY-MM-DD_HH-MM-SS.csv` / `.md` — фразы с метриками

### Поля в отчете

| Поле | Описание |
|------|----------|
| `phrase` | Поисковая фраза |
| `visits` | Визиты |
| `visitors` | Посетители |
| `pageviews` | Просмотры страниц |
| `bounce_rate` | Процент отказов |
| `page_depth` | Глубина просмотра |
| `avg_duration` | Среднее время на сайте (сек) |

## Ограничения

⚠️ API не позволяет получить поисковые фразы для конкретной страницы. Используйте `yandex-metrika-traffic` для анализа источников трафика по странице.
