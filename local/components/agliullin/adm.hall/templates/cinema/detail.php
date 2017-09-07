<?php
$APPLICATION->IncludeComponent(
    "agliullin:adm.hall.detail",
    "cinema",
    Array(
        "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
    ),
    $component
);?>