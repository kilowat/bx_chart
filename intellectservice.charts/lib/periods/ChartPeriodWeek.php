<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 19.11.2017
 * Time: 13:42
 */

namespace Intellectservice\Chart\Periods;

class ChartPeriodWeek extends  ChartPeriod{

    protected $_format = "d.m.y";

    public function __construct($count = 12)
    {
        parent::__construct($count);
    }

    protected  function generateDate(){

        for ($i = $this->_count; $i > -1; $i--) {
            $this->_axisXitem[] = date($this->_format, strtotime('-' . $i*7 . ' days'));
            $this->_filterMinDate[] = ConvertTimeStamp(AddToTimeStamp(array("DD" => "-" . $i*7), mktime(0, 0, 0, date("n"), date("j"), date("Y"))), "FULL");
            $this->_filterMaxDate[] = ConvertTimeStamp(AddToTimeStamp(array("DD" => "-" . $i*7 + 8, "SS" => -1), mktime(0, 0, 0, date("n"), date("j"), date("Y"))), "FULL");
        }
    }
}