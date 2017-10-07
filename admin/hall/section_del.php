<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!empty($_REQUEST['section_id']) && \Bitrix\Main\Loader::IncludeModule("reservation")) {
        $section_id = $_REQUEST['section_id'];
        try {
            $del = \Cinema\Reservation\SectionTable::delete($section_id);
            
            if ($del->isSuccess()) {
                $result = '{"status":"success","info":"Секция успешно удалена"}';
            } else { 
                $result = '{"status":"error","info":"Возникла ошибка при удалении секции"}';
            }
        } catch (Exception $e) {
            $result = '{"status":"error","info":"Возникла ошибка при удалении секции"}';
        }
    } else { 
        $result = '{"status":"error","info":"Возникла ошибка при удалении секции"}';
    }
} else { 
    $result = '{"status":"error","info":"Возникла ошибка при удалении секции"}';
}

echo $result;

?>