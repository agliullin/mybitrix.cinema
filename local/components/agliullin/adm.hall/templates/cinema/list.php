<?php
$APPLICATION->IncludeComponent(
    "agliullin:adm.hall.list",
    "cinema",
    Array (
        "SORT_BY" => $arParams["SORT_BY"],
        "SORT_ORDER" => $arParams["SORT_ORDER"],
    )
);
?>