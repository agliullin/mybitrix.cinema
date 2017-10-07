<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
$APPLICATION->SetTitle('Сеанс фильма "' . $arResult["FILM"]["NAME"] . '". ' . $arResult["HALL"]["NAME"] . '. ' .  $arResult["SEANCE"]["START_TIME"]);
$array = $arResult["HALL"]["SCHEME"];
$price_array = array();
$prices = split(";", $arResult["SEANCE"]["SECTION_PRICES"]);
foreach ($prices as $price) {
    $price = split("-", $price);
    $price_array[$price[0]] = $price[1];
}
$info = $USER->GetID() . '-' . $arResult["SEANCE"]["ID"] . '-' . $arResult["HALL"]["ID"];
?>
<style>
    table {
        text-align: center;
        width: 100%;
        margin-top: 20px;
    }
    .seat {
        cursor:pointer;
        transform: scale(2);
    }
    button {
        margin-top: 10px;
    }
    .result {
        margin-top: 10px;
    }
    .ticket {
        display: inline-flex;
        padding: 5px;
    }
    .free {
        background-color: rgb(140, 255, 140);
    }
    .reserved {
        background-color: rgb(255, 88, 88);
    }
    .bought {
        background-color: #ffd07b;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Сеанс фильма "<?=$arResult["FILM"]["NAME"]?>". <?=$arResult["HALL"]["NAME"]?>. <?=$arResult["SEANCE"]["START_TIME"]?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <img  width="100%" src="<?=CFile::GetPath($arResult["FILM"]["PROPERTY"]["POSTER"]["VALUE"])?>" />
            </div>
            <div class="col-md-9">
                <p>
                <b>Страна</b>: <?=$arResult["FILM"]["PROPERTY"]["COUNTRY"]["VALUE"]?></br>
                <b>Год</b>: <?=$arResult["FILM"]["PROPERTY"]["YEAR"]["VALUE"]?></br>
                <b>Режиссер</b>: <?=$arResult["FILM"]["PROPERTY"]["DIRECTOR"]["VALUE"]?></br>
                <b>Жанр</b>:
                <?php 
                $genres = "";
                foreach ($arResult["FILM"]["PROPERTY"]["GENRE"]["VALUE"] as $genre) {
                    $genres .= $genre . ", ";
                }
                $genres = substr($genres, 0, -2);
                echo $genres;
                ?>
                </br>
                <b>Продолжительность</b>: <?=$arResult["FILM"]["PROPERTY"]["DURATION"]["VALUE"]?> мин<br>
                <b>Возраст</b>: <?=$arResult["FILM"]["PROPERTY"]["AGE"]["VALUE"]?>+<br>
                <b>В главных ролях</b>: <?=$arResult["FILM"]["PROPERTY"]["ACTOR"]["VALUE"]?><br>
                <b>Описание</b>: <?=$arResult["FILM"]["PROPERTY"]["DESCRIPTION"]["VALUE"]?><br>
                </p>
            </div>
        </div><br><br>
        <div class="row">
            <div class="col-md-12">
                <table border="1"><tr><td>Экран</td></tr></table><br>
                <?php
                echo '<table class="table table-hover" cellpadding="5" cellspacing="5">';
                for ($i = 1; $i < max(array_keys($array)) + 1; $i++) {
                    echo "<tbody><tr>";
                    echo "<td align='left'>".$i."</td>";
                    for ($j = 1; $j < $arResult["HALL"]["MAX_COLUMN"] + 1; $j++) {
                        if ($array[$i][$j] != NULL) {
                            $UserID = $USER->GetId();
                            if (!empty($UserID) && $arResult["HALL"]["TICKET"][$i][$j] == $UserID) {
                                echo '<td class="bg-warning" title="Ряд - '.$i.'. Место - '.$j.'."><img width="25px" src="/images/checked.png"></td>';
                            } else if ($arResult["HALL"]["TICKET"][$i][$j] != NULL) {
                                echo '<td class="bg-danger" title="Ряд - '.$i.'. Место - '.$j.'."><img width="25px" src="/images/warning.png"></td>';
                            } else if (!$USER->IsAuthorized()) {
                                echo '<td class="bg-success" title="Ряд - '.$i.'. Место - '.$j.'."><img width="25px" src="/images/unchecked.png"></td>';
                            } else {
                                echo '<td class="bg-success"><input type="checkbox" class="seat" name="'.$i.'-'.$j.'" title="Ряд - '.$i.'. Место - '.$j.'."></td>';
                            }
                        } else {
                            echo "<td></td>";
                        }
                    }
                    echo "<td align='right'>".$i."</td>";
                    echo "</tr></tbody>";
                }
                ?></table>
                <div class="panel panel-default result">
                    <div class="panel-body">
                        <div class="detail"></div> 
                    </div>
                    <div class="panel-footer"><div class="price"></div></div>
                </div>
                <buttun class="btn btn-primary add">Забронировать</buttun>
                <div class="info"></div>
            </div>
        </div>
    </div>
</div>


<script>
    
var summaryPrice = 0;
$('.detail').html('Места не выбраны.');
$('.price').html('Общая цена: ' + summaryPrice + ' руб.');
$('input[type=checkbox].seat').on('click', function() {
    showCheckedPlace();
});
var tickets = '';
function showCheckedPlace() {
    tickets = '';
    result = '';
    var summaryPrice = 0;
    $.each($('input[type=checkbox].seat:checked'), function() {
        
        $(this).addClass('checked');
        var Array =<?php echo json_encode($array);?>;
        var priceArray =<?php echo json_encode($price_array)?>;
        var name = $(this).attr("name");
        var values = name.split('-');
        if (Array[values[0]][values[1]] == null) {
            Array[values[0]][values[1]] = 0;
            result += '<div class="ticket"><span class="label label-danger">Возникла ошибка при выборе места.</span></div>';
        } else {
            Array[values[0]][values[1]] = priceArray[Array[values[0]][values[1]]];
            summaryPrice += +Array[values[0]][values[1]];
            tickets += values[0] + '-' + values[1] + '-' + Array[values[0]][values[1]] + ';';
            result += '<div class="ticket"><span class="label label-success">Ряд: ' + values[0]
                + '. Место: ' + values[1]
                + '. Цена: ' + Array[values[0]][values[1]] + '.</span></div>';
        }
        
    });
    $.each($('input[type=checkbox].seat:not(:checked)'), function() {
        $(this).removeClass('checked');
    });
    if (result == '') {
        result = 'Места не выбраны.';
    }
    $('.detail').html(result);
    $('.price').html('Общая цена: ' + summaryPrice + ' руб.');
}
</script>


<script>
$('.add').on('click', function() {
    $tickets = tickets.substring(0, tickets.length - 1);
    $info = '<?php echo $info?>';
    
    $data = {
        data: $tickets,
        info: $info
    };
    
    $.ajax({
        type: 'post',
        url: '/seance/add.php',
        data: $data,	
        success: function(result) {
            var tmp = JSON.parse(result);
            if (tmp.status) {
                if (tmp.status == 'success') {
                    location.reload();
                } else {
                    $(".info").html(tmp.info);
                }
            }

        }
    });
    
});

</script>