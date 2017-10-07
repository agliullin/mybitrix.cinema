<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) 
	die();

class SeanceDetail extends CBitrixComponent
{
    public function executeComponent()
    {
        if (\Bitrix\Main\Loader::IncludeModule("reservation") && \Bitrix\Main\Loader::IncludeModule("film")) {
            $this->arResult["SEANCE"] = \Cinema\Reservation\SeanceTable::getById($this->arParams["ELEMENT_ID"])->fetch();
            $Film = new Film();
            $this->arResult["FILM"] = $Film->GetById($this->arResult["SEANCE"]["ID_FILM"]);
            
            $HallScheme = \Cinema\Reservation\SchemeTable::getList(array(
                'filter' => array("ID_HALL" => $this->arResult["SEANCE"]["ID_HALL"]),
                'order' => array("ID_ROW" => "ASC", "ID_COLUMN" => "ASC")
            ));
            
            $this->arResult["HALL"] = \Cinema\Reservation\HallTable::getList(array(
                'filter' => array("ID" => $this->arResult["SEANCE"]["ID_HALL"]),
            ))->fetch();
            
            $Tickets = \Cinema\Reservation\TicketTable::getList(array(
                'filter' => array("ID_SEANCE" => $this->arParams["ELEMENT_ID"]),
                'order' => array("ID_ROW" => "ASC", "ID_COLUMN" => "ASC")
            ));
            
            while ($Ticket = $Tickets->fetch()) {
                $this->arResult["HALL"]["TICKET"][$Ticket["ID_ROW"]][$Ticket["ID_COLUMN"]] = $Ticket["ID_USER"];
            }
            
            $this->arResult["HALL"]["MAX_COLUMN"] = 0;
            while ($Seat = $HallScheme->fetch()) {
                if ($Seat["ID_COLUMN"] > $this->arResult["HALL"]["MAX_COLUMN"]) {
                    $this->arResult["HALL"]["MAX_COLUMN"] = $Seat["ID_COLUMN"];
                }
                $this->arResult["HALL"]["SCHEME"][$Seat["ID_ROW"]][$Seat["ID_COLUMN"]] = $Seat["ID_SECTION"];
            }
            
        }
        $this->IncludeComponentTemplate();

    }
	
    public function SetSelectParams() {
        $SelectParams = array(
            "ID", 
            "IBLOCK_ID",
            "SECTION_ID",
            "NAME",
            "ACTIVE",
            "PROPERTY_ROW",
            "PROPERTY_PLACE",
            "PROPERTY_SECTION"
        );
        return $SelectParams;
    }
	
    public function SetOrderParams() {
        $OrderParams = array(
            "PROPERTY_ROW" => "ASC",
            "PROPERTY_PLACE" => "ASC",
        );
        return $OrderParams;
    }
	
    public function SetFilterParams($section_id) {
        $FilterParams = array (
            "IBLOCK_TYPE" => $this->arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $this->arParams["HALL_IBLOCK_ID"],
            "SECTION_ID" => $section_id,
            "ACTIVE" => "Y",
        );
        return $FilterParams;
    }
    
}