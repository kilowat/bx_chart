<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 19.11.2017
 * Time: 13:39
 */

namespace Intellectservice\Chart\Charts;


class OrderChartBx extends ChartBX{

    public function getAxisY()
    {
        $resQuery = array();
        $count = count($this->_chartPeriod->getAxisItem());

        for($i = 0 ; $count>$i;$i++){

            $select = array(new \Bitrix\Main\Entity\ExpressionField('COUNT', 'COUNT(%s)', 'ID'));
            $filter = array(
                ">=DATE_INSERT"=> $this->_chartPeriod->getFilterMinDate($i),
                "<=DATE_INSERT"=> $this->_chartPeriod->getFilterMaxDate($i));

            $resQueryCurrent = $this->queryFromOrderTable($select, $filter);

            $resQuery[$i] = $resQueryCurrent["COUNT"];
        }
        return $resQuery;
    }

    public function render()
    {
        $this->_label = $this->_userConfig["LABEL_LANG_WORDS"]["GD_INSERVES_CHART_TOTAL_ORDER"];

        $this->addPayedData();

        parent::render();
    }

    private function addPayedData()
    {
        $resQuery = array();
        $count = count($this->_chartPeriod->getAxisItem());

        for($i = 0 ; $count>$i;$i++){

            $select = array(new \Bitrix\Main\Entity\ExpressionField('COUNT', 'COUNT(%s)', 'ID'));
            $filter = array(
                ">=DATE_INSERT"=> $this->_chartPeriod->getFilterMinDate($i),
                "<=DATE_INSERT"=> $this->_chartPeriod->getFilterMaxDate($i),
                "=PAYED" => "Y");

            $resQueryCurrent = $this->queryFromOrderTable($select, $filter);

            $resQuery[$i] = $resQueryCurrent["COUNT"];
        }

        $this->_data[] =
            array(
                "label" => $this->_userConfig["LABEL_LANG_WORDS"]["GD_INSERVES_CHART_PAYED_ORDER"],
                "data" => $resQuery,
                "backgroundColor" => "rgba(100, 200, 132, 0.2)",
                "borderColor" => "rgba(100, 200, 132, 0.9)",
                "borderWidth" => 1
            );
    }
}