<?php
namespace Intellectservice\Chart\Charts;

class OrderPayedChartBx extends  ChartBX
{
    private $orderPayedId = "order_payed_procent_id";

    public function getAxisY()
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
                  "<=DATE_INSERT"=> $this->_chartPeriod->getFilterMaxDate($i));

              $resQueryCurrentAllOrder = $this->queryFromOrderTable($select, $filter);
              $totalOrders = intval($resQueryCurrentAllOrder["COUNT"]);

              $select = array(new \Bitrix\Main\Entity\ExpressionField('COUNT', 'COUNT(%s)', 'ID'));
              $filter = array(
                  ">=DATE_INSERT"=> $this->_chartPeriod->getFilterMinDate($i),
                  "<=DATE_INSERT"=> $this->_chartPeriod->getFilterMaxDate($i),
                  "=PAYED" => "Y",
              );

              $resQueryCurrentPayedOrder = $this->queryFromOrderTable($select, $filter);
              $payedOrders = intval($resQueryCurrentPayedOrder["COUNT"]);

              if($totalOrders === 0)
                  $resQuery[$i] = 0;
              else
                  $resQuery[$i] = intval($payedOrders / $totalOrders * 100);
          }
          $this->_obCache->StartDataCache($this->_cacheTime, $this->getCacheId($this->orderPayedId), $this->_cacheDir);
          $this->_obCache->EndDataCache($resQuery);
        }
        return $resQuery;
    }

    public function render()
    {
        $this->_label = $this->_userConfig["LABEL_LANG_WORDS"]["GD_INSERVES_CHART_PROCENT_PAYED_ORDER"];
        $this->_stepSize = 10;
        parent::render();
    }
}
