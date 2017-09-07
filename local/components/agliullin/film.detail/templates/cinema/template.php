<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
?>
<div class="panel panel-default">
    <div class="panel-heading">
            <h3 class="panel-title"><?=$arResult["ITEM"]["NAME"]?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-5">
                <img  width="100%" src="<?=CFile::GetPath($arResult["ITEM"]["PROPERTY"]["POSTER"]["VALUE"])?>" />
            </div>
            <div class="col-md-7">
                <p>
                <b>Страна</b>: <?=$arResult["ITEM"]["PROPERTY"]["COUNTRY"]["VALUE"]?></br>
                <b>Год</b>: <?=$arResult["ITEM"]["PROPERTY"]["YEAR"]["VALUE"]?></br>
                <b>Режиссер</b>: <?=$arResult["ITEM"]["PROPERTY"]["DIRECTOR"]["VALUE"]?></br>
                <b>Жанр</b>:
                <?php 
                $genres = "";
                foreach ($arResult["ITEM"]["PROPERTY"]["GENRE"]["VALUE"] as $genre) {
                    $genres .= $genre . ", ";
                }
                $genres = substr($genres, 0, -2);
                echo $genres;
                ?>
                </br>
                <b>Продолжительность</b>: <?=$arResult["ITEM"]["PROPERTY"]["DURATION"]["VALUE"]?> мин<br>
                <b>Возраст</b>: <?=$arResult["ITEM"]["PROPERTY"]["AGE"]["VALUE"]?>+<br>
                <b>В главных ролях</b>: <?=$arResult["ITEM"]["PROPERTY"]["ACTOR"]["VALUE"]?><br>
                <b>Описание</b>: <?=$arResult["ITEM"]["PROPERTY"]["DESCRIPTION"]["VALUE"]?><br>
                </p>
            </div>
        </div>
    </div>
</div>