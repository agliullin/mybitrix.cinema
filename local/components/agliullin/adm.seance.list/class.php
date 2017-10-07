<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) 
    die();


class AdmSeanceList extends CBitrixComponent
{
    public function executeComponent()
    {
        if (\Bitrix\Main\Loader::IncludeModule("reservation") && \Bitrix\Main\Loader::IncludeModule("film")) {
            $Seances = \Cinema\Reservation\SeanceTable::getList(array(
                'order' => array('ID' => 'DESC'),
                'limit' => $this->arParams["SEANCE_COUNT"],
            ))->fetchAll();
            foreach ($Seances as $Seance) {
                $Film = new Film();
                $Result["FILM"] = $Film->GetById($Seance["ID_FILM"]);
                $Result["SEANCE"] = $Seance;
                $this->arResult["SEANCE"][] = $Result;
            }
            $Film = new Film();
            $Film = $Film->GetList(false, array("IBLOCK_TYPE" => $this->arParams["IBLOCK_TYPE"], "IBLOCK_ID" => $this->arParams["IBLOCK_ID"]), false, false, false, false, false);
            $Hall = \Cinema\Reservation\HallTable::getList()->fetchAll();
            $this->arResult["FILM"] = $Film;
            $this->arResult["HALL"] = $Hall;
        }
        
        $this->IncludeComponentTemplate();
    }
}
