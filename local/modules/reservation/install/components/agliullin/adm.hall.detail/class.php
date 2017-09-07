<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) 
	die();

class HallDetail extends CBitrixComponent
{
    public function executeComponent()
    {
        if (\Bitrix\Main\Loader::IncludeModule("reservation")) {
            $this->arResult["HALL"] = \Cinema\Reservation\HallTable::getById($this->arParams["ELEMENT_ID"])->fetch();
            $HallScheme = \Cinema\Reservation\SchemeTable::getList(array(
                'filter' => array("ID_HALL" => $this->arParams["ELEMENT_ID"]),
                'order' => array("ID_ROW" => "ASC", "ID_COLUMN" => "ASC")
            ));
            
            $this->arResult["HALL"]["MAX_COLUMN"] = 0;
            while ($Seat = $HallScheme->fetch()) {
                if ($Seat["ID_COLUMN"] > $this->arResult["HALL"]["MAX_COLUMN"]) {
                    $this->arResult["HALL"]["MAX_COLUMN"] = $Seat["ID_COLUMN"];
                }
                $this->arResult["SCHEME"][$Seat["ID_ROW"]][$Seat["ID_COLUMN"]] = $Seat["ID_SECTION"];
            }
            $this->arResult["HALL"]["SECTION"] = \Cinema\Reservation\SectionTable::getList()->fetchAll();
        }
        
        $this->IncludeComponentTemplate();
    }
}
