<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) 
    die();


class SeanceList extends CBitrixComponent
{
    public function executeComponent()
    {
        if (\Bitrix\Main\Loader::IncludeModule("reservation") && \Bitrix\Main\Loader::IncludeModule("film")) {
            $Film = new Film();
            $NavParams = $this->SetNavParams();
            $SelectParams = $this->SetSelectParams();
            $OrderParams = $this->SetOrderParams();
            $FilterParams = $this->SetFilterParams();
            
            $Films = $Film->GetList($OrderParams, $FilterParams, false, $NavParams, $SelectParams, false, false);

            $SeanceOrderParams = $this->SetSeanceOrderParams();
            $SeanceFilterParams = $this->SetSeanceFilterParams();
            
            foreach ($Films["FILM"] as $Film) {
                $SeanceFilterParams = array_merge($SeanceFilterParams, array (
                    "ID_FILM" => $Film["ID"],
                ));
                $Seances = \Cinema\Reservation\SeanceTable::getList(array(
                    'filter' => $SeanceFilterParams,
                    'order' => $SeanceOrderParams
                ));
                while ($Seance = $Seances->fetch()) {
                    $Hall = \Cinema\Reservation\HallTable::getList(array(
                        'filter' => array("ID" => $Seance["ID_HALL"]),
                    ))->fetch();
                    $Seance["HALL"] = $Hall;
                    $Film["SEANCE"][] = $Seance;
                }
                
                $Result["FILM"][] = $Film;
            }
            
            $this->arResult = $Result;
            
            
            
            
            $Halls = \Cinema\Reservation\HallTable::getList(array(
                'order' => array("ID" => "ASC")
            ))->fetchAll();
            $this->arResult["FILTER"]["HALL"] = $Halls;
            $FilterParams = array (
                "IBLOCK_TYPE" => $this->arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                "ACTIVE" => "Y",
            );
            $SelectParams = array(
                "ID", 
                "IBLOCK_ID",
                "NAME",
                "ACTIVE"
            );
            $Film = new Film();
            $Films = $Film->GetList(array("ID" => "ASC"), $FilterParams, false, false, $SelectParams, false, false);
            $this->arResult["FILTER"]["FILM"] = $Films;
        }
        $this->IncludeComponentTemplate();		
    }
    
    // ФУНКЦИИ ДЛЯ ФИЛЬМА
    
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
            "ACTIVE" => "Y",
        ));
        if (!empty($this->arParams["F_FILM"]) && is_numeric($this->arParams["F_FILM"])) {
            $FilterParams = array_merge($FilterParams, array("ID" => $this->arParams["F_FILM"]));
        }
        return $FilterParams;
    }
    
    // ФУНКЦИИ ДЛЯ СЕАНСА
	
    public function SetSeanceOrderParams() {
        $SeanceOrderParams = array(
            $this->arParams["SEANCE_SORT_BY1"] => $this->arParams["SEANCE_SORT_ORDER1"],
            $this->arParams["SEANCE_SORT_BY2"] => $this->arParams["SEANCE_SORT_ORDER2"],
        );
        return $SeanceOrderParams;
    }
	
    public function SetSeanceFilterParams() {
        $SeanceFilterParams = array();
        if (!empty($this->arParams["F_HALL"]) && is_numeric($this->arParams["F_HALL"])) {
            $SeanceFilterParams = array_merge($SeanceFilterParams, array("ID_HALL" => $this->arParams["F_HALL"]));
        }
        if (!empty($this->arParams["F_DATE_START"])) {
                $date_start = new DateTime($this->arParams["F_DATE_START"]);
                $date_start = date('d.m.Y H:i:s', $date_start->getTimestamp());
                $SeanceFilterParams = array_merge($SeanceFilterParams, array(">=START_TIME" => $date_start));
        }
        if (!empty($this->arParams["F_DATE_END"])) {
                $date_end = new DateTime($this->arParams["F_DATE_END"]);
                $date_end = date('d.m.Y H:i:s', $date_end->getTimestamp());
                $SeanceFilterParams = array_merge($SeanceFilterParams, array("<=START_TIME" => $date_end));
        }
        return $SeanceFilterParams;
    }
}