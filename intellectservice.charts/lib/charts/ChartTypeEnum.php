<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 19.11.2017
 * Time: 13:44
 */

namespace Intellectservice\Chart\Charts;


class ChartTypeEnum{
    /*
     * Total orders
     */
    const CHART_ORDER = "CHART_ORDER";
    /*
     * Total sum of orders
     */
    const CHART_SUM = "CHART_SUM";
    /*
     * Sum of payed order
     */
    const CHART_ORDER_PAYED = "CHART_ORDER_PAYED";
    /*
     * Avg sum / count order
     */
    const CHART_AVG_ORDER = "CHART_AVG_ORDER";
}