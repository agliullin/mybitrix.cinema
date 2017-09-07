<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!empty($_REQUEST['seat_row']) && !empty($_REQUEST['seat_hall']) && !empty($_REQUEST['seat_column']) && \Bitrix\Main\Loader::IncludeModule("reservation")) {
       
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
                $del = \Cinema\Reservation\SchemeTable::delete($getValue["ID"]);
                if ($del->isSuccess()) {
                    $result = '{"status":"success","info":"Место успешно удалено"}';
                } else { 
                    $result = '{"status":"error","info":"Возникла ошибка при удалении места"}';
                }
            } else {
                $result = '{"status":"error","info":"Возникла ошибка при удалении места"}';
            }
        } catch (Exception $e) {
            $result = '{"status":"error","info":"Возникла ошибка sssпри удалении места"}';
        }
    } else { 
        $result = '{"status":"error","info":"Возникла ошибка при удалении места"}';
    }
} else { 
    $result = '{"status":"error","info":"Возникла ошибка при удалении места"}';
}

echo $result;

?>