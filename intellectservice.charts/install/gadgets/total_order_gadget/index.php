<?php
if(!CModule::IncludeModule("sale") || !CModule::IncludeModule("currency") || !CModule::IncludeModule("intellectservice.charts")
) throw  new Exception("Error include modules");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<?
use \Intellectservice\Chart\Charts\ChartTypeEnum;
use \Intellectservice\Chart\Periods\ChartPeriodEnum;

$chartType = $arGadgetParams["CHART_TYPE"] ? $arGadgetParams["CHART_TYPE"] : ChartTypeEnum::CHART_ORDER;
$chartPeriod = $arGadgetParams["PERIOD_TYPE"] ? $arGadgetParams["PERIOD_TYPE"] : ChartPeriodEnum::DAYS;
$countPeriod = $arGadgetParams["PERIOD_COUNT"] ? $arGadgetParams["PERIOD_COUNT"] : 7;
$block_height = $arGadgetParams["BLOCK_HEIGHT"] ? $arGadgetParams["BLOCK_HEIGHT"] : 400;
$block_width = $arGadgetParams["BLOCK_WIDTH"] ? $arGadgetParams["BLOCK_WIDTH"] : 800;
$diagram_view = $arGadgetParams["CHART_VIEW"] ? $arGadgetParams["CHART_VIEW"] : "bar";

$label_lang_words = array(
    "GD_INSERVES_CHART_AVG" => GetMessage("GD_INSERVES_CHART_AVG"),
    "GD_INSERVES_CHART_TOTAL_ORDER" => GetMessage( "GD_INSERVES_CHART_TOTAL_ORDER"),
    "GD_INSERVES_CHART_PAYED_ORDER" => GetMessage("GD_INSERVES_CHART_PAYED_ORDER"),
    "GD_INSERVES_CHART_PROCENT_PAYED_ORDER" => GetMessage("GD_INSERVES_CHART_PROCENT_PAYED_ORDER"),
    "GD_INSERVES_CHART_TOTAL_PRICE" => GetMessage("GD_INSERVES_CHART_TOTAL_PRICE"),
    "GD_INSERVES_CHART_TOTAL_PAYED_ORDER" => GetMessage("GD_INSERVES_CHART_TOTAL_PAYED_ORDER"),
);

$userConf = array(
        "diagram_view" => $diagram_view,
        "LABEL_LANG_WORDS" => $label_lang_words,
        "CACHE_TIME" => $arGadgetParams["CACHE_TIME"],
        );

$orderChart = \Intellectservice\Chart\ChartFactory::Create($chartType, $chartPeriod, $countPeriod, $userConf);
?>
<div >
    <div class="chart-container" style="position: relative; height:<?=$block_height?>px; width:<?=$block_width?>px">
    <canvas id="<?=spl_object_hash($orderChart)?>"></canvas>
    </div>
</div>
<script>
    var is_ctx = document.getElementById("<?=spl_object_hash($orderChart)?>").getContext('2d');
    var is_settings = <?$orderChart->render()?>;
    var chartBX = new Chart(is_ctx, is_settings );

</script>
