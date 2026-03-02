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
| `metrika_phrases.*` | Поисковые фразы с метриками: визиты, просмотры, отказы, время на сайте |

## Зависимости

Требует установленный [yandex-metrika-core](https://github.com/prikotov/yandex-metrika-core)

## Установка

### OpenCode

```bash
# Сначала установите core
git clone https://github.com/prikotov/yandex-metrika-core.git .opencode/skills/yandex-metrika-core

# Затем этот skill
git clone https://github.com/prikotov/yandex-metrika-search.git .opencode/skills/yandex-metrika-search
```

### KiloCode

```bash
# Сначала установите core
git clone https://github.com/prikotov/yandex-metrika-core.git .kilocode/skills/yandex-metrika-core

# Затем этот skill
git clone https://github.com/prikotov/yandex-metrika-search.git .kilocode/skills/yandex-metrika-search
```

## Использование

### Напрямую через PHP

**OpenCode:**
```bash
php .opencode/skills/yandex-metrika-search/metrika.php                    # последние 30 дней
php .opencode/skills/yandex-metrika-search/metrika.php 2026-01-01 2026-02-28  # свой период
```

**KiloCode:**
```bash
php .kilocode/skills/yandex-metrika-search/metrika.php                    # последние 30 дней
php .kilocode/skills/yandex-metrika-search/metrika.php 2026-01-01 2026-02-28  # свой период
```

### Через агента OpenCode

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

### В KiloCode

KiloCode поддерживает OpenCode Skills. После установки:

1. Откройте KiloCode в VS Code
2. Перейдите в режим **Agent**
3. Запросите отчёт:

```
Выполни skill yandex-metrika-search за январь 2026
```

```
Запусти отчёт по поисковым фразам через metrika.php
```

KiloCode выполнит PHP-скрипт и покажет путь к созданным файлам.

## Результаты

Отчёты сохраняются в папку с датой и временем запуска:

```
metrika_reports/
└── 2026-03-02_10-30-15/
    ├── metrika_phrases.csv
    └── metrika_phrases.md
```

CSV открывается в Excel/LibreOffice, Markdown — в любом текстовом редакторе или напрямую в Obsidian.

---

> Постановка задач, архитектура, ревью — [Dmitry Prikotov](https://prikotov.pro/), реализация — GLM-5 в [OpenCode](https://opencode.ai)
