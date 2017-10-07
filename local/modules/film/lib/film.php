<?php

class Film 
{
    function __construct() {
        CModule::IncludeModule("iblock");
    }

    public function GetById($Id) {
        $Film = CIBlockElement::GetById($Id)->GetNextElement();
        $Result = $Film->GetFields();
        $Result["PROPERTY"] = $Film->getProperties();
        return $Result;
    }

    public function GetByCode($Code) {
        $Film = CIBlockElement::GetList(Array(),Array("CODE" => $Code),false,false,Array())->GetNextElement();
        $Result = $Film->GetFields();
        $Result["PROPERTY"] = $Film->getProperties();
        return $Result;
    }
    
    public function GetList($OrderParams, $FilterParams, $GroupByParams, $NavParams, $SelectParams, 
            $DetailPageUrl, $ListPageUrl) {
        $Films = CIBlockElement::GetList($OrderParams, $FilterParams, $GroupByParams, $NavParams, $SelectParams);
        $Films->SetUrlTemplates($DetailPageUrl, "", $ListPageUrl);
        
        $Result = array();
        
        while ($Film = $Films->GetNextElement()) {
            $Item = $Film->GetFields();
            $Item["PROPERTY"] = $Film->getProperties();
            $Result["FILM"][] = $Item;
        }
        
        $Result["NAV_STRING"] = $Films->GetPageNavStringEx(
            $navComponentObject,
            "",
            "",
            "Y"
        );
        
        return $Result;
    }
}