<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
$APPLICATION->SetTitle("Сеанс с идентификатором #" . $arResult["SEANCE"]["ID"]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Информация о сеансе</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <fieldset>
                        <legend>Сеанс с идентификатором #<?=$arResult["SEANCE"]["ID"]?></legend>
                        <div class="col-md-12">
                            <div class="form-group seance">
                                <label for="id_hall" class="col-md-12">Зал</label>
                                <select class="form-control" name="id_hall" id="id_hall">
                                    <?php foreach ($arResult["HALL"] as $Hall ) { ?>
                                        <option <?php if ($arResult["SEANCE"]["ID_HALL"] == $Hall["ID"]) echo "selected" ?> value='<?=$Hall["ID"]?>'><?=$Hall["NAME"]?></option>
                                    <?php } ?>
                                </select><br>

                                <label for="id_film" class="col-md-12">Фильм</label>
                                <select class="form-control" name="id_film" id="id_film">
                                    <?php foreach ($arResult["FILM"]["FILM"] as $Film ) { ?>
                                        <option <?php if ($arResult["SEANCE"]["ID_FILM"] == $Film["ID"]) echo "selected" ?> value='<?=$Film["ID"]?>'><?=$Film["NAME"]?></option>
                                    <?php } ?>
                                </select><br>
                                <label for="start_time" class="col-md-12">Начало фильма</label>
                                <input type='datetime' id="start_time" class="form-control" value="<?=$arResult["SEANCE"]["START_TIME"]?>" name="start_time"/>
                                <br>
                                <label for="section_prices" class="col-md-12">Цены в секциях</label>
                                <input type='text' id="section_prices" class="form-control" value="<?=$arResult["SEANCE"]["SECTION_PRICES"]?>" name="section_prices"/>
                                <br>
                                <button class="btn btn-primary btn-md save" type="submit">Сохранить</button>
                                <button class="btn btn-danger btn-md delete" type="submit">Удалить</button>
                                <div class="result col-md-12"></div>
                            </div>

                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
$('button.save').on('click', function() {
    var $data = {
        id: <?=$arResult["SEANCE"]["ID"]?>,
        id_hall: $('#id_hall option:selected').val(),
        id_film: $('#id_film option:selected').val(),
        start_time: $('#start_time').val(),
        section_prices: $('#section_prices').val()
    };
    $.ajax({
        type: 'post',
        url: '/admin/seance/save.php',
        data: $data,	
        success: function(result) {
            var tmp = JSON.parse(result);
            if (tmp.status) {
                if (tmp.status == 'success') {
                    $(".result").html(tmp.info);
                } else {
                    $(".result").html(tmp.info);
                }
            }

        }
    });
});

    
$('button.delete').on('click', function() {
    var $data = {
        id: <?=$arResult["SEANCE"]["ID"]?>
    };
    $.ajax({
        type: 'post',
        url: '/admin/seance/delete.php',
        data: $data,	
        success: function(result) {
            var tmp = JSON.parse(result);
            if (tmp.status) {
                if (tmp.status == 'success') {
                    
                    document.location.href='../../';
                } else {
                    $(".result").html(tmp.info);
                }
            }

        }
    });
});
</script>