<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
?>

<style>
    .row-flex {
        display: flex;
        flex-flow: row wrap;
    }
    .name a {
        color: #000;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Сеансы</h3>
    </div>
    <div class="panel-body row-flex">
        <div class="col-md-12">
            <div class="well col-md-12">
                <fieldset>
                    <legend>Добавление сеанса</legend>
                    <div class="col-md-12">
                        <div class="form-group seance">
                            <label for="id_hall" class="col-md-12">Зал</label>
                            <select class="form-control" name="id_hall" id="id_hall">
                                <option value=''>Выберите зал</option>
                                <?php foreach ($arResult["HALL"] as $Hall ) { ?>
                                    <option value='<?=$Hall["ID"]?>'><?=$Hall["NAME"]?></option>
                                <?php } ?>
                            </select><br>

                            <label for="id_film" class="col-md-12">Фильм</label>
                            <select class="form-control" name="id_film" id="id_film">
                                <option value=''>Выберите фильм</option>
                                <?php foreach ($arResult["FILM"]["FILM"] as $Film ) { ?>
                                    <option value='<?=$Film["ID"]?>'><?=$Film["NAME"]?></option>
                                <?php } ?>
                            </select><br>
                            <label for="start_time" class="col-md-12">Начало сеанса</label>
                            <input type='datetime' id="start_time" class="form-control" value="" name="start_time"/>
                            <br>
                            <label for="section_prices" class="col-md-12">Цены в секциях</label>
                            <input type='text' id="section_prices" class="form-control" value="" name="section_prices"/>
                            <br>
                            <button class="btn btn-primary btn-md add" type="submit">Добавить</button>
                            <div class="result col-md-12"></div>
                        </div>

                    </div>
                </fieldset>
            </div>
        </div>
        <?php foreach ($arResult["SEANCE"] as $Seance) { ?>
        <div class="col-md-3">
            <div class="well">
                <a href="/film/<?=$Seance["FILM"]["CODE"]?>/">
                    <img width="100%" src="<?=CFile::GetPath($Seance["FILM"]["PROPERTY"]["POSTER"]["VALUE"])?>" />
                </a>
                <h4 class="text-center name">
                <a href="/film/<?=$Seance["FILM"]["CODE"]?>/">
                    <?=$Seance["FILM"]["NAME"]?>
                </a>
                </h4>
                <a class="btn btn-default btn-xs btn-block" href="/admin/seance/<?=$Seance["SEANCE"]["ID"]?>/">Подробнее</a>
            </div>
        </div>
        <?php } ?>
        <?php if ($arParams["FULL"] == "N") { ?>
            <a class="btn btn-default btn-md btn-block" href="/admin/seance/">Больше</a>
        <?php } ?>
    </div>
</div>

<script>
$('button.add').on('click', function() {
    var $data = {
        id_hall: $('#id_hall option:selected').val(),
        id_film: $('#id_film option:selected').val(),
        start_time: $('#start_time').val(),
        section_prices: $('#section_prices').val()
    };
    $.ajax({
        type: 'post',
        url: '/admin/seance/add.php',
        data: $data,	
        success: function(result) {
            var tmp = JSON.parse(result);
            if (tmp.status) {
                if (tmp.status == 'success') {
                    location.reload();
                } else {
                    $(".result").html(tmp.info);
                }
            }

        }
    });
});
</script>