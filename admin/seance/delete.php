<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!empty($_REQUEST['id']) && \Bitrix\Main\Loader::IncludeModule("reservation")) {
        try {
            $res = \Cinema\Reservation\SeanceTable::delete($_REQUEST['id']);
            if ($res->isSuccess()) {
                $result = '{"status":"success","info":"Сеанс удален"}';
            } else {
                $result = '{"status":"error","info":"Возникла ошибка при удалении сеанса"}';
            }
        } catch(Exception $e) {
            $result = '{"status":"error","info":"Возникла ошибка при удалении сеанса"}';
        }
    } else { 
        $result = '{"status":"error","info":"Возникла ошибка при удалении сеанса"}';
    }
} else { 
    $result = '{"status":"error","info":"Возникла ошибка при удалении сеанса"}';
}

echo $result;

?>