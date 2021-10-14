<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;
use OktaClient\ConfigProvider;

$aggregator = new ConfigAggregator([
    ConfigProvider::class,
    new PhpFileProvider(__DIR__ . '/application.php'),
]);

return $aggregator->getMergedConfig();
