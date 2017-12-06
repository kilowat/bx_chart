<?php
namespace Intellectservice\Chart\Charts;

use Intellectservice\Chart\Periods\ChartPeriod;

abstract class ChartBX
{
    protected $_defaultBackgroundColor = "rgba(255, 99, 132, 0.2)";
    protected $_defaultBorderColor = "rgba(255, 99, 132, 1)";
    protected $_chartPeriod;
    protected $_type = "line";
    protected $_backgroundColor;
    protected $_borderColor;
    protected $_label = "set label name";
    protected $_stepSize;
    protected $_data = array();
    protected $_userConfig = array();
    protected $_obCache;
    protected $_cacheTime;
    protected $_cacheDir = "intservice";
    private $_cacheId = 3600; // sec default cache
    private $_config = array();

    public function __construct(ChartPeriod $chartPeriod, array $userConfig = array())
    {
        $this->_chartPeriod = $chartPeriod;
        $this->_userConfig = $userConfig;
        $this->_obCache = \Bitrix\Main\Data\Cache::createInstance();
        $this->_cacheTime = 30;
        $this->_cacheId = md5(serialize($this->_chartPeriod));

        if(!empty($userConfig["CACHE_TIME"]))
          $this->_cacheTime = $userConfig["CACHE_TIME"];
    }

    public function getAxisX()
    {
        return $this->_chartPeriod->getAxisItem();
    }

    public abstract function getAxisY();

    protected function getCacheId($id)
    {
      return md5($this->_cacheId."_".$id);
    }

    protected function queryFromOrderTable($select, $filter)
    {
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

    public  function render()
    {
        $this->initConfig();
        echo \Bitrix\Main\Web\Json::encode($this->_config);
    }

    private function initConfig()
    {
        $this->_backgroundColor = $this->_defaultBackgroundColor;
        $this->_borderColor = $this->_defaultBorderColor;

        if(!empty($this->_userConfig["DIAGRAM_VIEW"])){
            $this->_type = $this->_userConfig["DIAGRAM_VIEW"];
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
