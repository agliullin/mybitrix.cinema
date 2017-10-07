<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) 
	die();

class FilmList extends CBitrixComponent
{
    public function executeComponent()
    {
        if (\Bitrix\Main\Loader::IncludeModule("film")) {
            $Film = new Film();
            $NavParams = $this->SetNavParams();
            $SelectParams = $this->SetSelectParams();
            $OrderParams = $this->SetOrderParams();
            $FilterParams = $this->SetFilterParams();
            $DetailPageUrl = $this->arParams["DETAIL_PAGE_URL"];
            $ListPageUrl = $this->arParams["LIST_PAGE_URL"];
            $this->arResult = $Film->GetList($OrderParams, $FilterParams, false, $NavParams, $SelectParams, $DetailPageUrl, $ListPageUrl);
        }
        $this->IncludeComponentTemplate();		
    }
	
    public function SetNavParams() {
        $NavParams = array(
            "nPageSize" => $this->arParams["FILMS_COUNT"],
        );
        return $NavParams;
    }
	
    public function SetSelectParams() {
        $SelectParams = array(
            "ID", 
            "IBLOCK_ID",
            "NAME",
            "ACTIVE",
            "CODE"
        );
        return $SelectParams;
    }
	
    public function SetOrderParams() {
        $OrderParams = array(
            $this->arParams["SORT_BY1"] => $this->arParams["SORT_ORDER1"],
            $this->arParams["SORT_BY2"] => $this->arParams["SORT_ORDER2"],
        );
        return $OrderParams;
    }
	
    public function SetFilterParams() {
        $FilterParams = array();
        $FilterParams = array_merge($FilterParams, array (
            "IBLOCK_TYPE" => $this->arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
        ));
        return $FilterParams;
    }
}