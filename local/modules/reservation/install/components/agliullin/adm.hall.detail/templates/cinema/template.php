<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
$APPLICATION->SetTitle($arResult["HALL"]["NAME"]);

?>
<style>
    .section {
        padding: 10px;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?=$arResult["HALL"]["NAME"]?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <table border="1" width="100%"><tr><td><center>Экран</center></td></tr></table><br>
                <?php
                echo '<table class="table table-hover" cellpadding="5" cellspacing="5">';
                for ($i = 1; $i < max(array_keys($arResult["SCHEME"])) + 1; $i++) {
                    echo "<tbody><tr>";
                    echo "<td>".$i."</td>";
                    for ($j = 1; $j < $arResult["HALL"]["MAX_COLUMN"] + 1; $j++) {
                        if ($arResult["SCHEME"][$i][$j] != NULL) {
                            echo '<td class="bg-success" title="Ряд - '.$i.'. Место - '.$j.'."><center>' . $arResult["SCHEME"][$i][$j] . '</center></td>';
                        } else {
                            echo "<td></td>";
                        }
                    }
                    echo "<td align='right'>".$i."</td>";
                    echo "</tr></tbody>";
                }
                ?></table>
                <div class="panel panel-default">
                    <div class="panel-body">
                        Цифры на местах обозначают номера секций:<br>
                        <?php foreach ($arResult["HALL"]["SECTION"] as $Section) { ?>
                            <span class="label label-info"><?=$Section["ID"]?> - <?=$Section["NAME"]?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="well">
                        <fieldset>
                            <legend>Секции</legend>
                            <div class="col-md-6">
                                <div class="form-group section">
                                    <label for="section_del" class="col-md-12">Удаление секции</label>
                                    <select class="form-control" name="section_del" id="section_del">
                                        <option value=''>Выберите секцию</option>
                                        <?php foreach ($arResult["HALL"]["SECTION"] as $Section ) { ?>
                                            <option value='<?=$Section["ID"]?>'><?=$Section["NAME"]?></option>
                                        <?php } ?>
                                    </select><br>                         
                                    <button class="btn btn-primary btn-sm btn-block section_del" type="submit">Удалить</button>
                                    <div class="section_del_info"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group section">
                                    <label name="section_add" class="col-md-12">Добавление секции</label>
                                    <div class="section_add">
                                        <input type='input' class="form-control" id="section_add" placeholder="Введите название секции" name="section_add"/>
                                    </div><br>
                                    <button class="btn btn-primary btn-sm btn-block section_add" type="submit">Добавить</button>
                                    <div class="section_add_info"></div>
                                </div>
                            </div>
                        </fieldset>
                </div>

                <div class="well">
                        <fieldset>
                            <legend>Места</legend>
                            <div class="col-md-12">
                                <div class="form-group seat">
                                    <label name="seat_row" class="col-md-12">Ряд</label>
                                    <div class="seat_row">
                                        <input type='input' class="form-control" id="seat_row" placeholder="Введите номер ряда" name="seat_row"/>
                                    </div><br>
                                    <label name="seat_column" class="col-md-12">Место</label>
                                    <div class="seat_column">
                                        <input type='input' class="form-control" id="seat_column" placeholder="Введите номер места" name="seat_column"/>
                                    </div><br>
                                    <label for="seat_section" class="col-md-12">Секция</label>
                                    <select class="form-control seat_section" name="seat_section" id="seat_section">
                                        <option value=''>Выберите секцию</option>
                                        <?php foreach ($arResult["HALL"]["SECTION"] as $Section ) { ?>
                                            <option value='<?=$Section["ID"]?>'><?=$Section["NAME"]?></option>
                                        <?php } ?>
                                    </select><br>  
                                    
                                    <div class="col-md-6">
                                    <button class="btn btn-primary btn-sm btn-block seat_del" type="submit">Удалить</button>
                                    <div class="seat_del_info"></div>
                                    </div>
                                    <div class="col-md-6">
                                    <button class="btn btn-primary btn-sm btn-block seat_add" type="submit">Добавить / Обновить</button>
                                    <div class="seat_add_info"></div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
$('button.section_del').on('click', function() {
    var $data = {
        section_id: $('#section_del option:selected').val()
    };
    $.ajax({
        type: 'post',
        url: '/admin/hall/section_del.php',
        data: $data,	
        success: function(result) {
            var tmp = JSON.parse(result);
            if (tmp.status) {
                if (tmp.status == 'success') {
                    location.reload();
                } else {
                    $(".section_del_info").html(tmp.info);
                }
            }

        }
    });
});

$('button.section_add').on('click', function() {
    var $data = {
        section_name: $('#section_add').val()
    };
    $.ajax({
        type: 'post',
        url: '/admin/hall/section_add.php',
        data: $data,	
        success: function(result) {
            var tmp = JSON.parse(result);
            if (tmp.status) {
                if (tmp.status == 'success') {
                    location.reload();
                } else {
                    $(".section_add_info").html(tmp.info);
                }
            }

        }
    });
});

$('button.seat_add').on('click', function() {
    $seat_hall = '<?=$arResult["HALL"]["ID"]?>';
    $seat_row = $('#seat_row').val();
    $seat_column = $('#seat_column').val();
    $seat_section = $('#seat_section option:selected').val();
    $data = {
        seat_hall: $seat_hall, 
        seat_section: $seat_section, 
        seat_row: $seat_row, 
        seat_column: $seat_column
    };
    $.ajax({
        type: 'post',
        url: '/admin/hall/seat_add.php',
        data: $data,	
        success: function(result) {
            var tmp = JSON.parse(result);
            if (tmp.status) {
                if (tmp.status == 'success') {
                    location.reload();
                } else {
                    $(".seat_add_info").html(tmp.info);
                }
            }

        }
    });
});


$('button.seat_del').on('click', function() {
    $seat_hall = '<?=$arResult["HALL"]["ID"]?>';
    $seat_row = $('#seat_row').val();
    $seat_column = $('#seat_column').val();
    $data = {
        seat_hall: $seat_hall, 
        seat_row: $seat_row, 
        seat_column: $seat_column
    };
    $.ajax({
        type: 'post',
        url: '/admin/hall/seat_del.php',
        data: $data,	
        success: function(result) {
            var tmp = JSON.parse(result);
            if (tmp.status) {
                if (tmp.status == 'success') {
                    location.reload();
                } else {
                    $(".seat_del_info").html(tmp.info);
                }
            }

        }
    });
});
</script>