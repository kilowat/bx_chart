<?php
namespace Intellectservice\Chart\Charts;

class AvgChartOrderBx extends ChartBX
{
    private $avg_chart_id = "avg";

    public function getAxisY()
    {
        $resQuery = array();

        if($this->_obCache->InitCache($this->_cacheTime, $this->getCacheId($this->avg_chart_id), $this->_cacheDir)){
      		$resQuery = $this->_obCache->GetVars();
        }else{

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
          $this->_obCache->StartDataCache($this->_cacheTime, $this->getCacheId($this->avg_chart_id), $this->_cacheDir);
          $this->_obCache->EndDataCache($resQuery);
        }

        return $resQuery;
    }

    public function render()
    {
        $this->_label =  $this->_userConfig["LABEL_LANG_WORDS"]["GD_INSERVES_CHART_AVG"];
        parent::render();
    }
}
