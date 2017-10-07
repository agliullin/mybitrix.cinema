<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!empty($_REQUEST['seat_section']) && !empty($_REQUEST['seat_row']) && !empty($_REQUEST['seat_hall']) && !empty($_REQUEST['seat_column']) && \Bitrix\Main\Loader::IncludeModule("reservation")) {
       
        try {
            $getValue = \Cinema\Reservation\SchemeTable::getList(
                array(
                    'filter' => array(
                                'ID_HALL' => $_REQUEST['seat_hall'],
                                'ID_ROW' => $_REQUEST['seat_row'],
                                'ID_COLUMN' => $_REQUEST['seat_column'],
                    )
                )
            )->fetch();
            if ($getValue) {
                $updateValue = \Cinema\Reservation\SchemeTable::update($getValue["ID"], array('ID_SECTION' => $_REQUEST['seat_section']));
                if ($updateValue) {
                    $result = '{"status":"success","info":"Место успешно обновлено"}';
                } else {
                    $result = '{"status":"error","info":"Возникла ошибка при обновлении места"}';
                }
            } else {
                if (\Cinema\Reservation\SchemeTable::add(array(
                    'ID_HALL' => $_REQUEST['seat_hall'],
                    'ID_SECTION' => $_REQUEST['seat_section'],
                    'ID_ROW' => $_REQUEST['seat_row'],
                    'ID_COLUMN' => $_REQUEST['seat_column'],
                    ))) {
                    $result = '{"status":"success","info":"Место успешно добавлено"}';
                } else { 
                    $result = '{"status":"error","info":"Возникла ошибка при добавлении места"}';
                }
            }
        } catch (Exception $e) {
            $result = '{"status":"error","info":"Возникла ошибка при добавлении места"}';
        }
    } else { 
        $result = '{"status":"error","info":"Возникла ошибка при добавлении места"}';
    }
} else { 
    $result = '{"status":"error","info":"Возникла ошибка при добавлении места"}';
}

echo $result;

?>