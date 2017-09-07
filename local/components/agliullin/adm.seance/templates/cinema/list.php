<?php
$APPLICATION->IncludeComponent(
    "agliullin:adm.seance.list",
    "cinema",
    Array (
        "SORT_BY" => $arParams["SORT_BY"],
        "SORT_ORDER" => $arParams["SORT_ORDER"],
        "SEANCE_COUNT" => $arParams["SEANCE_COUNT"],
        "FULL" => $arParams["FULL"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
    )
);
?>