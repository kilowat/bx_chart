<?php
namespace Intellectservice\Chart;

use Intellectservice\Chart\Charts\AvgChartOrderBx;
use Intellectservice\Chart\Charts\ChartTypeEnum;
use Intellectservice\Chart\Charts\OrderChartBx;
use Intellectservice\Chart\Charts\OrderPayedChartBx;
use Intellectservice\Chart\Charts\SumChartBx;
use Intellectservice\Chart\Periods\ChartPeriodDays;
use Intellectservice\Chart\Periods\ChartPeriodEnum;
use Intellectservice\Chart\Periods\ChartPeriodMonth;
use Intellectservice\Chart\Periods\ChartPeriodWeek;
use Intellectservice\Chart\Periods\ChartPeriodYears;

class ChartFactory
{
    public static function Create($type, $period, $countPeriod, $userConfig = array())
    {
        if($period == ChartPeriodEnum::DAYS){
            $p = new ChartPeriodDays($countPeriod);
        }
        if($period == ChartPeriodEnum::WEEKS){
            $p = new ChartPeriodWeek($countPeriod);
        }
        if($period == ChartPeriodEnum::MONTH){
            $p = new ChartPeriodMonth($countPeriod);
        }
        if($period == ChartPeriodEnum::YEARS){
            $p = new ChartPeriodYears($countPeriod);
        }
        if($type == ChartTypeEnum::CHART_ORDER){
            return new OrderChartBx($p, $userConfig);
        }
        if($type == ChartTypeEnum::CHART_SUM){
            return new SumChartBx($p, $userConfig);
        }
        if($type == ChartTypeEnum::CHART_ORDER_PAYED){
            return new OrderPayedChartBx($p, $userConfig);
        }
        if($type == ChartTypeEnum::CHART_AVG_ORDER){
            return new AvgChartOrderBx($p, $userConfig);
        }
        throw new Exception("Cannot to create class from ChartFactory...");
    }
}
