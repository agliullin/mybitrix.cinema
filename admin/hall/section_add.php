<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!empty($_REQUEST['section_name']) && \Bitrix\Main\Loader::IncludeModule("reservation")) {
        $section_name = $_REQUEST['section_name'];
        try {
            if (\Cinema\Reservation\SectionTable::add(array('NAME' => $section_name))) {
                $result = '{"status":"success","info":"Секция успешно добавлена"}';
            } else { 
                $result = '{"status":"error","info":"Возникла ошибка при добавлении секции"}';
            }
        } catch (Exception $e) {
            $result = '{"status":"error","info":"Возникла ошибка при добавлении секции"}';
        }
    } else { 
        $result = '{"status":"error","info":"Возникла ошибка при добавлении секции"}';
    }
} else { 
    $result = '{"status":"error","info":"Возникла ошибка при добавлении секции"}';
}

echo $result;

?>