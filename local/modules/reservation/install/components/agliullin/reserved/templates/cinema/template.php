<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php if ($arResult["SHOW"] == "N") {
    
} else {
?>
<style>
    .row-flex {
        display: flex;
        flex-flow: row wrap;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Забронированные билеты</h3>
    </div>
    <div class="panel-body row-flex">
        <?php
        foreach ($arResult["RESERVATION"] as $Ticket) { ?>
        <?php if ($arParams["FULL"] == "N") { ?>
            <div class="well col-md-12">
            <a href="/film/<?=$Ticket["FILM"]["CODE"]?>/">"<?=$Ticket["FILM"]["NAME"]?>"</a><br/>
            Зал: <?=$Ticket["HALL"]["NAME"]?>.<br/>
            Ряд: <?=$Ticket["TICKET"]["ID_ROW"]?>. Место: <?=$Ticket["TICKET"]["ID_COLUMN"]?>.<br/>
            Цена: <?=$Ticket["TICKET"]["PRICE"]?> руб.<br/>
            Дата: <?=$Ticket["SEANCE"]["START_TIME"]?>.<br/>
            <a href="/seance/<?=$Ticket["SEANCE"]["ID"]?>/"><button class="btn btn-default btn-xs">Перейти к сеансу</button></a><br/>
            </div>
        <?php } else { ?>
        <div class="well col-md-6">
            <div class="col-md-5">
                <a href="/film/<?=$Ticket["FILM"]["CODE"]?>/"><img width="100%" src="<?=CFile::GetPath($Ticket["FILM"]["PROPERTY"]["POSTER"]["VALUE"])?>" /></a>
            </div>
            <div class="col-md-7">
            <a href="/film/<?=$Ticket["FILM"]["CODE"]?>/">"<?=$Ticket["FILM"]["NAME"]?>"</a><br/>
            Зал: <?=$Ticket["HALL"]["NAME"]?>.<br/>
            Ряд: <?=$Ticket["TICKET"]["ID_ROW"]?>. Место: <?=$Ticket["TICKET"]["ID_COLUMN"]?>.<br/>
            Цена: <?=$Ticket["TICKET"]["PRICE"]?> руб.<br/>
            Дата: <?=$Ticket["SEANCE"]["START_TIME"]?>.<br/>
            <a href="/seance/<?=$Ticket["SEANCE"]["ID"]?>/"><button class="btn btn-default btn-xs ">Перейти к сеансу</button></a><br/>
            </div>
        </div>
            <?php } ?>
            <?php
        }?>
        <?php
        if (count($arResult["RESERVATION"]) == 0) {
            ?>
            <h4>Список пуст</h4>
            <?php
        }
        if ($arParams["FULL"] == "N" && count($arResult["RESERVATION"]) > 0) { ?>
        <div class="col-md-12">
            <a href="/ticket.php" class="btn btn-default btn-sm btn-block">Подробнее</a>
        </div> <?php } ?>
    </div>
</div>
<?php } ?>
