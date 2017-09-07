<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Забронированные билеты");
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
        </div>
        <div class="col-md-9">
            
            <?php
            $APPLICATION->IncludeComponent(
                "agliullin:reserved",
                "cinema",
                Array(
                    "FULL" => "Y",
                    "TICKETS_COUNT" => 20,
                )
            );?>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>