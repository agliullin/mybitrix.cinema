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
                "agliullin:adm.hall",
                "cinema",
                Array(
                    "SEF_FOLDER" => "/admin/hall/",
                    "SEF_MODE" => "Y",
                    "SORT_BY" => "ID",
                    "SORT_ORDER" => "ASC",
                )
            );?>
        </div>
    </div>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>