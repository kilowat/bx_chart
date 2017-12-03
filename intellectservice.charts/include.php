<?php

use \Bitrix\Main\Loader;
Loader::registerAutoLoadClasses($module = null, [
    'Intellectservice\Chart\Charts\ChartTypeEnum' => '/bitrix/modules/intellectservice.charts/lib/charts/ChartTypeEnum.php',
    'Intellectservice\Chart\Periods\ChartPeriodEnum' => '/bitrix/modules/intellectservice.charts/lib/periods/ChartPeriodEnum.php',
    'Intellectservice\Chart\ChartFactory' => '/bitrix/modules/intellectservice.charts/lib//ChartFactory.php',
    'Intellectservice\Chart\Charts\AvgChartOrderBx' => '/bitrix/modules/intellectservice.charts/lib/charts/AvgChartOrderBx.php',
    'Intellectservice\Chart\Charts\ChartBx' => '/bitrix/modules/intellectservice.charts/lib/charts/ChartBx.php',
    'Intellectservice\Chart\Charts\OrderChartBx' => '/bitrix/modules/intellectservice.charts/lib/charts/OrderChartBx.php',
    'Intellectservice\Chart\Charts\OrderPayedChartBx' => '/bitrix/modules/intellectservice.charts/lib/charts/OrderPayedChartBx.php',
    'Intellectservice\Chart\Charts\SumChartBx' => '/bitrix/modules/intellectservice.charts/lib/charts/SumChartBx.php',
    'Intellectservice\Chart\Periods\ChartPeriod' => '/bitrix/modules/intellectservice.charts/lib/periods/ChartPeriod.php',
    'Intellectservice\Chart\Periods\ChartPeriodDays' => '/bitrix/modules/intellectservice.charts/lib/periods/ChartPeriodDays.php',
    'Intellectservice\Chart\Periods\ChartPeriodMonth' => '/bitrix/modules/intellectservice.charts/lib/periods/ChartPeriodMonth.php',
    'Intellectservice\Chart\Periods\ChartPeriodWeek' => '/bitrix/modules/intellectservice.charts/lib/periods/ChartPeriodWeek.php',

]);

