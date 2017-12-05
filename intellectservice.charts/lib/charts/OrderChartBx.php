<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 19.11.2017
 * Time: 13:39
 */

namespace Intellectservice\Chart\Charts;


class OrderChartBx extends ChartBX{

    private $orderTotalId = "total_order_id";
    private $orderPayedId = "payed_order_id";

    public function getAxisY()
    {
        $resQuery = array();

        if($this->_obCache->InitCache($this->_cacheTime, $this->getCacheId($this->orderTotalId), $this->_cacheDir)){
          $resQuery = $this->_obCache->GetVars();
        }else{
          $count = count($this->_chartPeriod->getAxisItem());
          for($i = 0 ; $count>$i;$i++){
              $select = array(new \Bitrix\Main\Entity\ExpressionField('COUNT', 'COUNT(%s)', 'ID'));
              $filter = array(
                  ">=DATE_INSERT"=> $this->_chartPeriod->getFilterMinDate($i),
                  "<=DATE_INSERT"=> $this->_chartPeriod->getFilterMaxDate($i));

              $resQueryCurrent = $this->queryFromOrderTable($select, $filter);

              $resQuery[$i] = $resQueryCurrent["COUNT"];
          }

          $this->_obCache->StartDataCache($this->_cacheTime, $this->getCacheId($this->orderTotalId), $this->_cacheDir);
          $this->_obCache->EndDataCache($resQuery);
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
        if($this->_obCache->InitCache($this->_cacheTime, $this->getCacheId($this->orderPayedId), $this->_cacheDir)){
          $resQuery = $this->_obCache->GetVars();
        }else{
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
          $this->_obCache->StartDataCache($this->_cacheTime, $this->getCacheId($this->orderPayedId), $this->_cacheDir);
          $this->_obCache->EndDataCache($resQuery);
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
