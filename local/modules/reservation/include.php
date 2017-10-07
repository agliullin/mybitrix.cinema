<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
CModule::AddAutoloadClasses('reservation', array(
    '\Cinema\Reservation\SeanceTable' => '/lib/seance.php',
    '\Cinema\Reservation\HallTable' => '/lib/hall.php',
    '\Cinema\Reservation\TicketTable' => '/lib/ticket.php',
    '\Cinema\Reservation\SectionTable' => '/lib/section.php',
    '\Cinema\Reservation\SchemeTable' => '/lib/scheme.php'
));
?>