<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$aMenuLinks = Array(
	Array(
		"Главная", 
		"/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Фильмы", 
		"film/", 
		Array(), 
		Array(), 
		"" 
	),
        Array(
		"Панель администратора", 
		"admin/", 
		Array(), 
		Array(), 
		"CUser::isAdmin()" 
	)
);
?>