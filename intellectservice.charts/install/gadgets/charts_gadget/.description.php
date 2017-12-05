<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arDescription = Array(
    "NAME" => GetMessage("GD_INSERVES_CHART_MODULE_NAME"),
    "DESCRIPTION" => GetMessage("GD_INSERVES_CHART_MODULE_DESCR"),
    "ICON" => "",
    "GROUP" => Array("ID"=>"admin_store"),
    "NOPARAMS" => "Y",
    "OO_ONLY" => true,
    "AI_ONLY" => true
);
$MESS[""] = "Конверсия заказов";