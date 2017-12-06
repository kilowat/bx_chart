<?php
namespace Intellectservice\Chart\Periods;

class ChartPeriodDays extends ChartPeriod
{
    protected $_format = "d.m";

    public function __construct($count = 30)
    {
        parent::__construct($count);
    }
}
