<?php
namespace Intellectservice\Chart\Periods;

class ChartPeriodMonth extends ChartPeriod
{
    protected $_format = "m.y";

    public function __construct($count = 6)
    {
        parent::__construct($count);
    }

    protected  function generateDate()
    {
        $days = 0;

        for ($i = $this->_count; $i > -1; $i--) {
            $days+=$this->getDaysInMonth($i);
        }

        for ($i = $this->_count; $i > -1; $i--) {
            $days-=$this->getDaysInMonth($i);
            $this->_axisXitem[] = date($this->_format, strtotime('-' . $days . ' days'));
            $this->_filterMinDate[] = ConvertTimeStamp(AddToTimeStamp(array("DD" => "-" . $days - date('d')), mktime(0, 0, 0, date("n"), date("j"), date("Y"))), "FULL");
            $this->_filterMaxDate[] = ConvertTimeStamp(AddToTimeStamp(array("DD" => "-" . $days + $this->getDaysInMonth($i) - date('d'), "SS" => -1), mktime(0, 0, 0, date("n"), date("j"), date("Y"))), "FULL");
        }
    }
    private function getDaysInMonth($i = 0)
    {
        return  date('t', mktime(0,0,0,date('m')-$i,1,date('y')));
    }
}
