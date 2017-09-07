<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) 
    die();


class HallList extends CBitrixComponent
{
    public function executeComponent()
    {
        if (\Bitrix\Main\Loader::IncludeModule("reservation")) {
            $this->arResult["HALL"] = \Cinema\Reservation\HallTable::getList(array())->fetchAll();
        }
        
        $this->IncludeComponentTemplate();
    }
}
