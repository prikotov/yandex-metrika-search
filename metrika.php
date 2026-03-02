<?php

require_once __DIR__ . '/../yandex-metrika-core/MetrikaClient.php';

MetrikaClient::checkGitignore();
$config = MetrikaClient::loadConfig();

$dateFrom = $argv[1] ?? date('Y-m-d', strtotime('-30 days'));
$dateTo = $argv[2] ?? date('Y-m-d');

$client = new MetrikaClient(
    $config['client_id'],
    $config['client_secret'],
    $config['counter_id']
);

function getSearchPhrases(MetrikaClient $client, string $dateFrom, string $dateTo): array
{
    $data = $client->request([
        'ids' => $client->getCounterId(),
        'metrics' => 'ym:s:visits,ym:s:pageviews,ym:s:bounceRate,ym:s:avgVisitDurationSeconds',
        'dimensions' => 'ym:s:lastSearchPhrase',
        'date1' => $dateFrom,
        'date2' => $dateTo,
        'limit' => 1000,
        'sort' => '-ym:s:visits'
    ]);
    
    $result = [];
    foreach ($data['data'] ?? [] as $item) {
        $result[] = [
            'phrase' => $item['dimensions'][0]['name'] ?? '',
            'visits' => (int)($item['metrics'][0] ?? 0),
            'pageviews' => (int)($item['metrics'][1] ?? 0),
            'bounce_rate' => round($item['metrics'][2] ?? 0, 2),
            'avg_duration' => round($item['metrics'][3] ?? 0, 2)
        ];
    }
    
    return $result;
}

function getSearchPhrasesWithLanding(MetrikaClient $client, string $dateFrom, string $dateTo): array
{
    $data = $client->request([
        'ids' => $client->getCounterId(),
        'metrics' => 'ym:s:visits,ym:s:pageviews,ym:s:bounceRate',
        'dimensions' => 'ym:s:lastSearchPhrase,ym:s:startURL',
        'date1' => $dateFrom,
        'date2' => $dateTo,
        'limit' => 1000,
        'sort' => '-ym:s:visits'
    ]);
    
    $result = [];
    foreach ($data['data'] ?? [] as $item) {
        $result[] = [
            'phrase' => $item['dimensions'][0]['name'] ?? '',
            'landing_page' => $item['dimensions'][1]['name'] ?? '',
            'visits' => (int)($item['metrics'][0] ?? 0),
            'pageviews' => (int)($item['metrics'][1] ?? 0),
            'bounce_rate' => round($item['metrics'][2] ?? 0, 2)
        ];
    }
    
    return $result;
}

$reportPath = MetrikaClient::createReportDir();

echo "\n  Папка отчета: metrika_reports/" . basename($reportPath) . "\n";
echo "  Период: $dateFrom — $dateTo\n\n";

$phrases = getSearchPhrases($client, $dateFrom, $dateTo);
$phrasesWithPages = getSearchPhrasesWithLanding($client, $dateFrom, $dateTo);

MetrikaClient::saveCsv($phrases, "$reportPath/metrika_phrases.csv");
MetrikaClient::saveMarkdown($phrases, "$reportPath/metrika_phrases.md", "Поисковые фразы", $dateFrom, $dateTo);
MetrikaClient::saveCsv($phrasesWithPages, "$reportPath/metrika_phrases_pages.csv");
MetrikaClient::saveMarkdown($phrasesWithPages, "$reportPath/metrika_phrases_pages.md", "Фразы и страницы входа", $dateFrom, $dateTo);

echo "  Создано файлов:\n";
echo "    - metrika_phrases.csv\n";
echo "    - metrika_phrases.md\n";
echo "    - metrika_phrases_pages.csv\n";
echo "    - metrika_phrases_pages.md\n";
echo "\n  Найдено фраз: " . count($phrases) . "\n\n";
