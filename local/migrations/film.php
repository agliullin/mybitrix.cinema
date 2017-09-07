<?php 
/* Проверка, что миграция запускается через консоль */
$is_console = PHP_SAPI == 'cli' || (!isset($_SERVER['DOCUMENT_ROOT']) && !isset($_SERVER['REQUEST_URI']));
if ($is_console === false) {
	die();
}
/* Time limit */
@set_time_limit(0);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('CHK_EVENT', true);
define("NO_AGENT_CHECK", true);
/* Подключение prolog_before */
$_SERVER["DOCUMENT_ROOT"] = realpath(__DIR__ . '/../../');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
/* Подключение модуля */
CModule::IncludeModule("iblock");

/* Создание/обновление типа ИБ "Фильмы" */
$arFields = Array(
	'ID'=>'film',
	'SECTIONS'=>'Y',
	'IN_RSS'=>'N',
	'SORT'=>10,
	'LANG'=>Array(
		'ru'=>Array(
			'NAME'=>'Фильмы',
			'SECTION_NAME'=>'Разделы',
			'ELEMENT_NAME'=>'Работодатель'
		),
		'en'=>Array(
			'NAME'=>'Films',
			'SECTION_NAME'=>'Sections',
			'ELEMENT_NAME'=>'Employer'
		)
	)
);
	
$obBlocktype = CIBlockType::GetByID('film');
$obBlocktypeArray = $obBlocktype->Fetch();
if (count($obBlocktypeArray["arResult"]) == 0) {
	$obBlocktype = new CIBlockType;
	$DB->StartTransaction();
	$res = $obBlocktype->Add($arFields);
	if(!$res) {
		$DB->Rollback();
		echo $obBlocktype->LAST_ERROR.'<br>';
	} else {
		$DB->Commit();
	}
} else {
	$obBlocktype = new CIBlockType;
	$DB->StartTransaction();
	$res = $obBlocktype->Update('employer', $arFields);
	if(!$res) {
		$DB->Rollback();
		echo $obBlocktype->LAST_ERROR.'<br>';
	} else {
		$DB->Commit();
	}
}

/* Создание/обновление ИБ "Работодатели" */
$ID = 0;
$arFields = Array(
	"ACTIVE" => "Y",
	"NAME" => "Фильмы",
	"CODE" => "films",
	"IBLOCK_TYPE_ID" => "film",
	"SITE_ID" => "s1",
	"SORT" => 10,
	"DESCRIPTION" => "Фильмы",
	"DESCRIPTION_TYPE" => "text",
	"GROUP_ID" => Array("1"=>"D", "2"=>"R")
);
$ib = new CIBlock;
$ID = $ib->Add($arFields);
if($ID === false){
    echo $ib->LAST_ERROR.'<br>';
}
$ibp = new CIBlockProperty;
$arFields = Array(
	"NAME" => "Страна",
	"ACTIVE" => "Y",
	"SORT" => "10",
	"CODE" => "COUNTRY",
	"PROPERTY_TYPE" => "S",
	"IBLOCK_ID" => $ID,
);
$PropID = $ibp->Add($arFields);
$arFields = Array(
	"NAME" => "Год",
	"ACTIVE" => "Y",
	"SORT" => "10",
	"CODE" => "YEAR",
	"PROPERTY_TYPE" => "N",
	"IBLOCK_ID" => $ID,
);
$PropID = $ibp->Add($arFields);
$arFields = Array(
	"NAME" => "Режиссер",
	"ACTIVE" => "Y",
	"SORT" => "10",
	"CODE" => "DIRECTOR",
	"PROPERTY_TYPE" => "S",
	"IBLOCK_ID" => $ID,
);
$PropID = $ibp->Add($arFields);
$arFields = Array(
	"NAME" => "Жанр",
	"ACTIVE" => "Y",
	"SORT" => "10",
	"CODE" => "GENRE",
	"PROPERTY_TYPE" => "L",
	"IBLOCK_ID" => $ID,
);
$PropID = $ibp->Add($arFields);
$arFields = Array(
	"NAME" => "Длительность",
	"ACTIVE" => "Y",
	"SORT" => "10",
	"CODE" => "DURATION",
	"PROPERTY_TYPE" => "N",
	"IBLOCK_ID" => $ID,
);
$PropID = $ibp->Add($arFields);
$arFields = Array(
	"NAME" => "Возраст",
	"ACTIVE" => "Y",
	"SORT" => "10",
	"CODE" => "AGE",
	"PROPERTY_TYPE" => "N",
	"IBLOCK_ID" => $ID,
);
$PropID = $ibp->Add($arFields);
$arFields = Array(
	"NAME" => "В главных ролях",
	"ACTIVE" => "Y",
	"SORT" => "10",
	"CODE" => "ACTOR",
	"PROPERTY_TYPE" => "S",
	"IBLOCK_ID" => $ID,
);
$PropID = $ibp->Add($arFields);
$arFields = Array(
	"NAME" => "Описание",
	"ACTIVE" => "Y",
	"SORT" => "10",
	"CODE" => "DESCRIPTION",
	"PROPERTY_TYPE" => "S",
	"IBLOCK_ID" => $ID,
);
$PropID = $ibp->Add($arFields);
$arFields = Array(
	"NAME" => "Постер",
	"ACTIVE" => "Y",
	"SORT" => "10",
	"CODE" => "POSTER",
	"PROPERTY_TYPE" => "F",
	"IBLOCK_ID" => $ID,
);
$PropID = $ibp->Add($arFields);
?>