<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) 
	die();

class AdmSeanceDetail extends CBitrixComponent
{
    public function executeComponent()
    {
        if (\Bitrix\Main\Loader::IncludeModule("reservation") && \Bitrix\Main\Loader::IncludeModule("film")) {
            $Seance = \Cinema\Reservation\SeanceTable::getById($this->arParams["ELEMENT_ID"])->fetch();
            $Film = new Film();
            $Film = $Film->GetList(false, array("IBLOCK_TYPE" => $this->arParams["IBLOCK_TYPE"], "IBLOCK_ID" => $this->arParams["IBLOCK_ID"]), false, false, false, false, false);
            $Hall = \Cinema\Reservation\HallTable::getList()->fetchAll();
            $this->arResult["SEANCE"] = $Seance;
            $this->arResult["FILM"] = $Film;
            $this->arResult["HALL"] = $Hall;
        }
        
        $this->IncludeComponentTemplate();
    }
}
