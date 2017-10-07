<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Фильмы");
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
                "agliullin:film", 
                "cinema", 
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "COMPONENT_TEMPLATE" => "cinema",
                    "IBLOCK_ID" => "5",
                    "IBLOCK_TYPE" => "film",
                    "FILMS_COUNT" => "18",
                    "SEF_FOLDER" => "/film/",
                    "SEF_MODE" => "Y",
                    "SORT_BY1" => "DATE_CREATE",
                    "SORT_BY2" => "NAME",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "SEF_URL_TEMPLATES" => array(
                        "list" => "",
                        "detail" => "#ELEMENT_CODE#/",
                    ),
                    "DETAIL_PAGE_URL" => "/film/#ELEMENT_CODE#/",
                    "LIST_PAGE_URL" => "/film/",
                ),
                false
            );?>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>