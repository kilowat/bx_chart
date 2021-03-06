<?php
namespace Intellectservice\Chart\Periods;

class ChartPeriodYears extends ChartPeriod
{
    protected $_format = "y";

    public function __construct($count = 6)
    {
        parent::__construct($count);
    }

    protected  function generateDate()
    {
        $days = 0;

        for ($i = $this->_count; $i > -1; $i--) {
            $days+=$this->getDaysInYear($i);
        }

        for ($i = $this->_count; $i > -1; $i--) {
            $days-=$this->getDaysInYear($i);
            $this->_axisXitem[] = date($this->_format, strtotime('-' . $days . ' days'));
            $this->_filterMinDate[] = ConvertTimeStamp(AddToTimeStamp(array("DD" => "-" . $days - date('d')), mktime(0, 0, 0, date("n"), date("j"), date("Y"))), "FULL");
            $this->_filterMaxDate[] = ConvertTimeStamp(AddToTimeStamp(array("DD" => "-" . $days + $this->getDaysInYear($i) - date('d'), "SS" => -1), mktime(0, 0, 0, date("n"), date("j"), date("Y"))), "FULL");
        }
    }
    private function getDaysInYear($i = 0)
    {
        return 365 + date("L", mktime(0,0,0, 7,7, $i));
    }
}
