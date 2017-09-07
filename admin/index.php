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
           <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Панель администратора</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $APPLICATION->IncludeComponent(
                        "agliullin:adm.hall",
                        "cinema",
                        Array(
                            "SORT_BY" => "ID",
                            "SORT_ORDER" => "ASC",
                        )
                    );?>
                    <?php
                    $APPLICATION->IncludeComponent(
                        "agliullin:adm.seance",
                        "cinema",
                        Array(
                            "SORT_BY" => "ID",
                            "SORT_ORDER" => "ASC",
                            "SEANCE_COUNT" => 8,
                            "FULL" => "N",
                            "IBLOCK_ID" => "5",
                            "IBLOCK_TYPE" => "film",
                        )
                    );?>
                </div>
           </div>
        </div>
    </div>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>