<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 19.11.2017
 * Time: 13:41
 */

namespace Intellectservice\Chart\Periods;


abstract class ChartPeriod
{

    protected $_count;
    protected $_filterMinDate = array();
    protected $_filterMaxDate = array();
    protected $_axisXitem = array();
    protected $_format = "d.m";

    public function __construct($count = 30)
    {
        $this->_count = $count;
        $this->generateDate();
    }

    protected  function generateDate()
    {
        for ($i = $this->_count; $i > -1; $i--) {
            $this->_axisXitem[] = date($this->_format, strtotime('-' . $i . ' days'));
            $this->_filterMinDate[] = ConvertTimeStamp(AddToTimeStamp(array("DD" => "-" . $i), mktime(0, 0, 0, date("n"), date("j"), date("Y"))), "FULL");
            $this->_filterMaxDate[] = ConvertTimeStamp(AddToTimeStamp(array("DD" => "-" . $i + 1, "SS" => -1), mktime(0, 0, 0, date("n"), date("j"), date("Y"))), "FULL");
        }
    }

    public function getFilterMinDate($index)
    {
        return $this->_filterMinDate[$index];
    }

    public function getFilterMaxDate($index)
    {
        return $this->_filterMaxDate[$index];
    }

    public function getAxisItem()
    {
        return $this->_axisXitem;
    }
}
