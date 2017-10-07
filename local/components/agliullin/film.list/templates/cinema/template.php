<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
?>
<style>
    .row-flex {
        display: flex;
        flex-flow: row wrap;
    }
    .well.film {
        margin: -10px;
        padding: 5px;
        margin-bottom: 15px;
    }
    .title a {
        font-weight: 600;
        color: #3e3f3a;
    }    
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Фильмы</h3>
    </div>
    <div class="panel-body">
        <div class="row row-flex">
        <?php foreach($arResult["FILM"] as $arItem) { ?>
        <div class="col-md-3">
            <div class="well film">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <img  width="100%" src="<?=CFile::GetPath($arItem["PROPERTY"]["POSTER"]["VALUE"])?>" />
                </a>
                <h4 class="title"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></h4>
                <p>
                <b>Страна</b>: <?=$arItem["PROPERTY"]["COUNTRY"]["VALUE"]?></br>
                <b>Год</b>: <?=$arItem["PROPERTY"]["YEAR"]["VALUE"]?></br>
                <b>Режиссер</b>: <?=$arItem["PROPERTY"]["DIRECTOR"]["VALUE"]?></br>
                <b>Жанр</b>:
                <?php 
                $genres = "";
                foreach ($arItem["PROPERTY"]["GENRE"]["VALUE"] as $genre) {
                    $genres .= $genre . ", ";
                }
                $genres = substr($genres, 0, -2);
                echo $genres;
                ?>
                </br>
                <b>Продолжительность</b>: <?=$arItem["PROPERTY"]["DURATION"]["VALUE"]?> мин<br>
                <b>Возраст</b>: <?=$arItem["PROPERTY"]["AGE"]["VALUE"]?>+<br>
                <b>В главных ролях</b>: <?=$arItem["PROPERTY"]["ACTOR"]["VALUE"]?><br>
                </p>
            </div>
        </div>
        <?php } ?>
        </div>
    <?=$arResult["NAV_STRING"];?>
    </div>
</div>