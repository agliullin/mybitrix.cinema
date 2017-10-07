<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
?>
<style>
    .row-flex {
        display: flex;
        flex-flow: row wrap;
    }
    .title a {
        font-weight: 600;
        color: #3e3f3a;
    }    
    .left {
        text-align: left;
    }
    .main-label {
        padding-top: 13px;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Сеансы</h3>
    </div>
    <div class="panel-body">
        <div class="well">
            <form class="form-horizontal" action="index.php" method="post">
                <fieldset>
                    <legend>Фильтрация</legend>
                    <div class="form-group">
                        <label for="f_hall" class="col-lg-1 main-label">Зал</label>
                        <div class="col-lg-5">
                            <select class="form-control f_hall" name="f_hall">
                                <option value=''>Выберите зал</option>
                                <?php foreach ($arResult["FILTER"]["HALL"] as $Hall ) { ?>
                                    <option <?php if (isset($_POST["f_hall"]) && $_POST["f_hall"] == $Hall["ID"]) echo "selected"; ?> value='<?=$Hall["ID"]?>'><?=$Hall["NAME"]?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label for="f_film" class="col-lg-1 main-label">Фильм</label>
                        <div class="col-lg-5">
                            <select class="form-control f_film" name="f_film">
                                <option value=''>Выберите фильм</option>
                                <?php foreach ($arResult["FILTER"]["FILM"]["FILM"] as $Film ) { ?>
                                    <option <?php if (isset($_POST["f_film"]) && $_POST["f_film"] == $Film["ID"]) echo "selected"; ?> value='<?=$Film["ID"]?>'><?=$Film["NAME"]?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 main-label">Дата сеанса</label>
                        <div class="date ">
                            <div class="col-md-5">
                                <input type='date' class="form-control" value="<?=$_POST["f_date_start"]?>"  name="f_date_start"/>
                            </div>
                            <div class="col-md-5">
                                <input type='date' class="form-control"  value="<?=$_POST["f_date_end"]?>" name="f_date_end"/>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-sm btn-block" type="submit">Применить</button>
                </fieldset>
            </form>
        </div>
        <div class="row row-flex">
        <?php foreach($arResult["FILM"] as $arItem) { ?>
            <div class="well">
                <div class="col-md-2">
                    <a href="/film/<?=$arItem["CODE"]?>/">
                        <img  width="100%" src="<?=CFile::GetPath($arItem["PROPERTY"]["POSTER"]["VALUE"])?>" />
                    </a>
                </div>
                <div class="col-md-6">
                    <h4 class="title"><a href="/film/<?=$arItem["CODE"]?>/"><?=$arItem["NAME"]?></a></h4>
                    <p>
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
                <div class="col-md-4">
                    <h4>Расписание</h4>
                    <?php 
                    foreach($arItem["SEANCE"] as $Seance) {  ?>
                    <p>
                        <a href="/seance/<?=$Seance["ID"]?>/">
                            <?=$Seance["START_TIME"]?> <?=$Seance["HALL"]["NAME"]?>
                        </a>
                    </p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
        </div>
    <?=$arResult["NAV_STRING"];?>
    </div>
</div>
