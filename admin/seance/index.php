<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Панель администратора");
if (!$USER->isAdmin()) {
    LocalRedirect('/index.php');
}
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
                "agliullin:adm.seance",
                "cinema",
                Array(
                    "SEF_FOLDER" => "/admin/seance/",
                    "SEF_MODE" => "Y",
                    "SORT_BY" => "ID",
                    "SORT_ORDER" => "ASC",
                    "SEANCE_COUNT" => 20,
                    "FULL" => "Y",
                    "IBLOCK_ID" => "5",
                    "IBLOCK_TYPE" => "film",
                )
            );?>
        </div>
    </div>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>