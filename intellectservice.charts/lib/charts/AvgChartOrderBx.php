<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 19.11.2017
 * Time: 13:41
 */

namespace Intellectservice\Chart\Charts;


class AvgChartOrderBx extends ChartBX{
    /*
     * Avg order sum / orderCount
     */
    public function getAxisY()
    {
        $resQuery = array();
        $count = count($this->_chartPeriod->getAxisItem());
        for ($i = 0; $count > $i; $i++) {

            $select = array(new \Bitrix\Main\Entity\ExpressionField("PRICE", "SUM(PRICE)"));

            $filter = array(
                ">=DATE_INSERT" => $this->_chartPeriod->getFilterMinDate($i),
                "<=DATE_INSERT" => $this->_chartPeriod->getFilterMaxDate($i));

            $resQueryCurrent = $this->queryFromOrderTable($select, $filter);

            $totalOrderSum = $resQueryCurrent["PRICE"];


            $select = array(new \Bitrix\Main\Entity\ExpressionField('COUNT', 'COUNT(%s)', 'ID'));
            $filter = array(
                ">=DATE_INSERT"=> $this->_chartPeriod->getFilterMinDate($i),
                "<=DATE_INSERT"=> $this->_chartPeriod->getFilterMaxDate($i),
                "=PAYED" => "Y",
            );

            $resQueryCurrentPayedOrder = $this->queryFromOrderTable($select, $filter);
            $payedOrders = intval($resQueryCurrentPayedOrder["COUNT"]);

            if($payedOrders == 0)
                $payedOrders = 1;

            if($totalOrderSum === 0){
                $resQuery[$i] = 0;
            }else{
                $resQuery[$i] = intval($totalOrderSum / $payedOrders);
            }
        }
        return $resQuery;
    }

    public function render()
    {
        $this->_label = "Средний чек (Сумма / кол-во)";
        parent::render();
    }
}