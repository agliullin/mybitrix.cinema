<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
CModule::AddAutoloadClasses('film', array(
    'Film' => '/lib/film.php',
));
?>