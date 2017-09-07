<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) 
	die();
class FilmDetail extends CBitrixComponent
{
    public function executeComponent()
    {
        if (\Bitrix\Main\Loader::IncludeModule("film")) {
            $Film = new Film();
            $Item = $Film->GetByCode($this->arParams["ELEMENT_CODE"]);
            $this->arResult["ITEM"] = $Item;
        }
        $this->IncludeComponentTemplate();

    }
}