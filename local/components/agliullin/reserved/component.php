<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
global $USER;
if (!$USER->IsAuthorized()) {
    $this->arResult["SHOW"] = "N";
} else {
    $this->arResult["SHOW"] = "Y";
    if (\Bitrix\Main\Loader::IncludeModule("reservation") && \Bitrix\Main\Loader::IncludeModule("film")) {
        $Tickets = \Cinema\Reservation\TicketTable::getList(array(
            'filter' => array("ID_USER" => $USER->GetId()),
            'order' => array("ID" => "DESC", "ID_ROW" => "ASC", "ID_COLUMN" => "ASC"),
            'limit' => $this->arParams["TICKETS_COUNT"]
        ))->fetchAll();
        foreach ($Tickets as $Ticket) {
            $Seance = \Cinema\Reservation\SeanceTable::getById($Ticket["ID_SEANCE"])->fetch();
            $Film = new Film();
            $Film = $Film->GetById($Seance["ID_FILM"]);
            $Hall = \Cinema\Reservation\HallTable::getById($Ticket["ID_HALL"])->fetch();
            $Result["SEANCE"] = $Seance;
            $Result["FILM"] = $Film;
            $Result["TICKET"] = $Ticket;
            $Result["HALL"] = $Hall;
            $this->arResult["RESERVATION"][] = $Result;
        }
    }
}
$this->IncludeComponentTemplate(); ?>