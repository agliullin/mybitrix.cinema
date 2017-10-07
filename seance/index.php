<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сеансы");
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
            $APPLICATION->IncludeComponent(
                "agliullin:auth",
                "cinema",
                Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "REGISTER_URL" => "register.php"
                )
            );?>
            <?php
            $APPLICATION->IncludeComponent(
                "agliullin:reserved",
                "cinema",
                Array(
                    "FULL" => "N",
                    "TICKETS_COUNT" => 5,
                )
            );?>
        </div>
        <div class="col-md-9">
            <?php 
            $APPLICATION->IncludeComponent(
                "agliullin:seance", 
                "cinema", 
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "COMPONENT_TEMPLATE" => "cinema",
                    "SEANCE_IBLOCK_ID" => "6",
                    "SEANCE_IBLOCK_TYPE" => "film",
                    "FILMS_COUNT" => "6",
                    "SEF_FOLDER" => "/seance/",
                    "SEF_MODE" => "Y",
                    "SEANCE_SORT_BY1" => "PROPERTY_START_TIME",
                    "SEANCE_SORT_BY2" => "NAME",
                    "SEANCE_SORT_ORDER1" => "ASC",
                    "SEANCE_SORT_ORDER2" => "ASC",
                    "SEF_URL_TEMPLATES" => array(
                        "list" => "",
                        "detail" => "#ELEMENT_ID#/",
                    ),
                    "SEANCE_DETAIL_PAGE_URL" => "/seance/#ELEMENT_ID#/",
                    "SEANCE_LIST_PAGE_URL" => "/seance/",
                    
                    "IBLOCK_ID" => "5",
                    "IBLOCK_TYPE" => "film",
                    "HALL_IBLOCK_ID" => "7",
                    "SORT_BY1" => "DATE_CREATE",
                    "SORT_BY2" => "NAME",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "F_HALL" => $_POST["f_hall"],
                    "F_FILM" => $_POST["f_film"],
                    "F_DATE_START" => $_POST["f_date_start"],
                    "F_DATE_END" => $_POST["f_date_end"],
                    "F_AGE" => $_POST["f_age"],
                ),
                false
            );?>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>