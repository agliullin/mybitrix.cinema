<?php
$APPLICATION->IncludeComponent(
    "agliullin:adm.seance.detail",
    "cinema",
    Array(
        "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
    ),
    $component
);?>