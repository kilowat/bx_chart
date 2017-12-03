<?php
$arParameters = Array(
    "PARAMETERS"=> Array(),
    "USER_PARAMETERS"=> Array(
        "CHART_TYPE" => array(
            "NAME" => GetMessage("GD_INSERVES_CHART_TYPE_NAME"),
            "TYPE" => "LIST",
            "VALUES" => array(
                "CHART_ORDER" => GetMessage("GD_INSERVES_CHART_TYPE_VALUES_CHART_ORDER"),
                "CHART_ORDER_PAYED" => GetMessage("GD_INSERVES_CHART_TYPE_VALUES_CHART_ORDER_PAYED"),
                "CHART_SUM" => GetMessage("GD_INSERVES_CHART_TYPE_VALUES_CHART_SUM"),
                "CHART_AVG_ORDER" => GetMessage("GD_INSERVES_CHART_TYPE_VALUES_CHART_AVG_ORDER"),
            ),
        ),
        "CHART_VIEW" => array(
            "NAME" => GetMessage("GD_INSERVES_CHART_VIEW_NAME"),
            "TYPE" => "LIST",
            "VALUES" => array(
                "bar" => GetMessage("GD_INSERVES_CHART_VIEW_VALUES_bar"),
                "line" => GetMessage("GD_INSERVES_CHART_VIEW_VALUES_line"),
            ),
        ),
        "PERIOD_TYPE" => array(
            "NAME" => GetMessage("GD_INSERVES_CHART_PERIOD_TYPE_NAME"),
            "TYPE" => "LIST",
            "VALUES" => array(
                "MONTH" => GetMessage("GD_INSERVES_CHART_PERIOD_TYPE_VALUES_MONTH"),
                "WEEKS" => GetMessage("GD_INSERVES_CHART_PERIOD_TYPE_VALUES_WEEK"),
                "DAYS" => GetMessage("GD_INSERVES_CHART_PERIOD_TYPE_VALUES_DAYS"),
            ),
        ),
        "PERIOD_COUNT"=> Array(
            "NAME" => GetMessage("GD_INSERVES_CHART_PERIOD_COUNT"),
            "TYPE" => "STRING",
            "DEFAULT" => 7,
        ),
        "BLOCK_HEIGHT"=> Array(
            "NAME" => GetMessage("GD_INSERVES_CHART_HIGHT"),
            "TYPE" => "STRING",
            "DEFAULT" => 400,
        ),
        "BLOCK_WIDTH"=> Array(
            "NAME" => GetMessage("GD_INSERVES_CHART_WIDTH"),
            "TYPE" => "STRING",
            "DEFAULT" => 800,
        ),
    ),
);