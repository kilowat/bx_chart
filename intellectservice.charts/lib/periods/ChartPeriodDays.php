<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 19.11.2017
 * Time: 13:42
 */

namespace Intellectservice\Chart\Periods;


class ChartPeriodDays extends ChartPeriod{

    protected $_format = "d.m";

    public function __construct($count = 30)
    {
        parent::__construct($count);

    }
}