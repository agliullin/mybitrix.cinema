<?php
$APPLICATION->IncludeComponent(
    "agliullin:seance.list",
    "cinema",
    Array (
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "FILMS_COUNT" => $arParams["FILMS_COUNT"],	
        "SEANCE_DETAIL_PAGE_URL" => $arParams["SEANCE_DETAIL_PAGE_URL"],
        "SEANCE_LIST_PAGE_URL" => $arParams["SEANCE_LIST_PAGE_URL"],
        "SORT_BY1" => $arParams["SORT_BY1"],
        "SORT_BY2" => $arParams["SORT_BY2"],
        "SORT_ORDER1" => $arParams["SORT_ORDER1"],
        "SORT_ORDER2" => $arParams["SORT_ORDER2"],
        "SEANCE_SORT_BY1" => $arParams["SEANCE_SORT_BY1"],
        "SEANCE_SORT_BY2" => $arParams["SEANCE_SORT_BY2"],
        "SEANCE_SORT_ORDER1" => $arParams["SEANCE_SORT_ORDER1"],
        "SEANCE_SORT_ORDER2" => $arParams["SEANCE_SORT_ORDER2"],
        "F_HALL" => $arParams["F_HALL"],
        "F_FILM" => $arParams["F_FILM"],
        "F_DATE_START" => $arParams["F_DATE_START"],
        "F_DATE_END" => $arParams["F_DATE_END"],
        "F_AGE" => $arParams["F_AGE"],
    )
);
?>