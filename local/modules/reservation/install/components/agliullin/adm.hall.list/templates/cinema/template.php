<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Залы</h3>
    </div>
    <div class="panel-body">
        <?php foreach ($arResult["HALL"] as $Hall) { ?>
        <a class="btn btn-default btn-md btn-block" href="/admin/hall/<?=$Hall["ID"]?>/"><?=$Hall["NAME"]?></a>
        <?php } ?>
    </div>
</div>