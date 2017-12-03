<?php
namespace Intellectservice\Chart\Charts;

use Intellectservice\Chart\Periods\ChartPeriod;

abstract class ChartBX{

    protected $_defaultBackgroundColor = "rgba(255, 99, 132, 0.2)";
    protected $_defaultBorderColor = "rgba(255, 99, 132, 1)";
    protected $_chartPeriod;
    protected $_type = "line";
    protected $_backgroundColor;
    protected $_borderColor;
    protected $_label = "set label name";
    protected $_stepSize;
    protected $_data = array();
    private $_config = array();
    protected $_userConfig = array();

    public function __construct(ChartPeriod $chartPeriod, array $userConfig = array())
    {
        $this->_chartPeriod = $chartPeriod;
        $this->_userConfig = $userConfig;
    }

    public function getAxisX()
    {
        return $this->_chartPeriod->getAxisItem();
    }

    public abstract function getAxisY();

    protected function queryFromOrderTable($select, $filter){

        $resOrder = \Bitrix\Sale\Internals\OrderTable::getList(array(
            'select' => $select,
            'filter' => $filter
        ));

        while($res = $resOrder->Fetch())
        {
            $result = $res;
        }
        return $result;
    }

    public  function render(){
        $this->initConfig();
        echo json_encode($this->_config);
    }

    private function initConfig(){
        $this->_backgroundColor = $this->_defaultBackgroundColor;
        $this->_borderColor = $this->_defaultBorderColor;

        if(!empty($this->_userConfig["diagram_view"])){
            $this->_type = $this->_userConfig["diagram_view"];
        }

        $this->_data[] =
            array(
                "label" => $this->_label,
                "data" => $this->getAxisY(),
                "backgroundColor" => $this->_backgroundColor,
                "borderColor" => $this->_borderColor,
                "borderWidth" => 1
        );

        $this->_config   = array(
            "type" => $this->_type,
            "data" => array(
                "labels" => $this->getAxisX(),
                "datasets" => $this->_data,
            ),
            "options" => array(
                "maintainAspectRatio"=> false,
                "scales" => array(
                    "yAxes" => array(
                        array(
                            "ticks" => array(
                                "min" => 1,
                                "stepSize" => $this->_stepSize,
                            )),
                    )
                )
            )
        );
    }
}