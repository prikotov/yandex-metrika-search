# Yandex Metrika Search Phrases

> Поисковые фразы из Яндекс.Метрики для SEO-анализа

## Зачем это нужно

Этот skill извлекает реальные поисковые запросы, по которым пользователи находят ваш сайт в поисковых системах. Данные помогают:

- **Найти новые идеи для контента** — какие темы интересуют вашу аудиторию
- **Оптимизировать существующие страницы** — увидеть, по каким запросам приходят на конкретные страницы
- **Отследить эффективность SEO** — как меняются запросы со временем
- **Обнаружить неожиданные запросы** — иногда пользователи находят сайт по неожиданным фразам

## Что вы получите

Отчёт в форматах CSV и Markdown:

| Файл | Содержание |
|------|------------|
| `yandex_metrika_phrases.*` | Поисковые фразы с метриками: визиты, просмотры, отказы, время на сайте |
| `yandex_metrika_phrases_pages.*` | Кросс-отчёт: поисковые фразы + страницы входа (запуск `phrases_pages.php`) |

## Зависимости

Требует установленный [yandex-metrika-core](https://github.com/prikotov/yandex-metrika-core)

## Установка

Skill совместим с различными AI-агентами. Примеры ниже даны для OpenCode — для других инструментов смотрите их документацию по установке skills.

```bash
# Сначала установите core
git clone https://github.com/prikotov/yandex-metrika-core.git .opencode/skills/yandex-metrika-core

# Затем этот skill
git clone https://github.com/prikotov/yandex-metrika-search.git .opencode/skills/yandex-metrika-search
```

## Использование

### Напрямую через PHP

```bash
# Базовые запросы
php .opencode/skills/yandex-metrika-search/metrika.php                    # последние 30 дней
php .opencode/skills/yandex-metrika-search/metrika.php 2026-01-01 2026-02-28  # свой период

# С параметрами
php .opencode/skills/yandex-metrika-search/metrika.php -l 20              # топ-20 фраз
php .opencode/skills/yandex-metrika-search/metrika.php -s bounce_rate     # сортировка по отказам
```

### Параметры

| Параметр | Сокращение | Описание | Пример |
|----------|------------|----------|--------|
| `--site` | | Имя сайта из конфига | `--site task.ai-aid.pro` |
| `--limit` | `-l` | Лимит записей | `-l 20` |
| `--sort` | `-s` | Поле сортировки | `-s bounce_rate` |
| `--order` | `-o` | Порядок: asc/desc | `-o asc` |

### Ограничения API

⚠️ **API Яндекс.Метрики не поддерживает:**
- Фильтрацию поисковых фраз по конкретной странице
- Комбинацию "поисковая фраза + страница входа"

Для анализа источников трафика по странице используйте `yandex-metrika-traffic`:
```bash
php .opencode/skills/yandex-metrika-traffic/traffic.php -p "rag-s-nulya"
```

### Через агента

После установки skill агент автоматически узнаёт о нём. Примеры запросов:

```
Выгрузи поисковые фразы за последний месяц
```

```
Собери статистику по поисковым запросам с 1 января по 28 февраля
```

```
Мне нужно проанализировать, по каким запросам находят сайт. 
Сделай выгрузку за последние 30 дней.
```

## Результаты

Отчёты сохраняются в папку с датой и временем запуска:

```
yandex_metrika_reports/
└── 2026-03-02_10-30-15/
    ├── yandex_metrika_phrases.csv
    └── yandex_metrika_phrases.md
```

CSV открывается в Excel/LibreOffice, Markdown — в любом текстовом редакторе или напрямую в Obsidian.

---

> Постановка задач, архитектура, ревью — [Dmitry Prikotov](https://prikotov.pro/), реализация — GLM-5 в [OpenCode](https://opencode.ai)
