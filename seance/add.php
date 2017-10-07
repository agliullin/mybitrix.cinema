<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!empty($_REQUEST['data']) && !empty($_REQUEST['info']) && \Bitrix\Main\Loader::IncludeModule("reservation")) {
        $tickets = split(';', $_REQUEST['data']);
        $info = split('-', $_REQUEST['info']);
        foreach ($tickets as $ticket) {
            $values = split('-', $ticket);
            $DB->StartTransaction();
            $check = \Cinema\Reservation\TicketTable::getList(array(
                'filter' => array(
                    'ID_USER' => $info[0], 
                    'ID_SEANCE' => $info[1],
                    'ID_HALL' => $info[2],
                    'ID_ROW' => $values[0],
                    'ID_COLUMN' => $values[1]
                )
            ))->fetch();
            
            $fields = array(
                'ID_USER' => $info[0], 
                'ID_SEANCE' => $info[1],
                'ID_HALL' => $info[2],
                'ID_ROW' => $values[0],
                'ID_COLUMN' => $values[1],
                'PRICE' => $values[2]
            );
            if ($check == NULL) {
                if ($DB->Insert("reservation_ticket", $fields, __LINE__)) {
                    $DB->Commit();
                    $result = '{"status":"success","info":"Билеты успешно забронированы."}';
                } else {
                    $DB->Rollback();
                    $result = '{"status":"success","info":"Возникла ошибка при бронировании."}';
                }
            } else { 
                $DB->Rollback();
                $result = '{"status":"success","info":"Возникла ошибка при бронировании."}';
            }
        }
    } else {
        $result = '{"status":"error","info":"Возникла ошибка при отправлении данных."}';
        
    }
    echo $result;
} else {
    $result = '{"status":"error","info":"Возникла ошибка при отправленни данных."}';
    echo $result;
}

?>