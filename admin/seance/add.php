<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
use Bitrix\Main\Type;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!empty($_REQUEST['id_hall']) && !empty($_REQUEST['id_film']) && !empty($_REQUEST['start_time']) && !empty($_REQUEST['section_prices']) && \Bitrix\Main\Loader::IncludeModule("reservation")) {
        $fields = array(
            'ID_HALL' => $_REQUEST['id_hall'],
            'ID_FILM' => $_REQUEST['id_film'],
            'START_TIME' => new Type\DateTime($_REQUEST['start_time']),
            'SECTION_PRICES' => $_REQUEST['section_prices'],
        );
        if (\Cinema\Reservation\SeanceTable::add($fields)) {
            $result = '{"status":"success","info":"Сеанс добавлен"}';
        } else {
            $result = '{"status":"error","info":"Возникла ошибка при добавлении сеанса"}';
        }
    } else { 
        $result = '{"status":"error","info":"Возникла ошибка при добавлении сеанса"}';
    }
} else { 
    $result = '{"status":"error","info":"Возникла ошибка при добавлении сеанса"}';
}

echo $result;

?>