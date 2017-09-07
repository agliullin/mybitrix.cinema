<?php
namespace Cinema\Reservation;

use Bitrix\Main\Entity;

class SchemeTable extends Entity\DataManager
{
    public static function getFilePath()
    {
        return __FILE__;
    }

    public static function getTableName() {
        return "reservation_scheme";
    }
    
    public static function getMap() {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true,
            )),
            new Entity\IntegerField("ID_HALL", array(
                'required' => true,
            )),
            new Entity\IntegerField("ID_SECTION", array(
                'required' => true,
            )),
            new Entity\IntegerField("ID_ROW", array(
                'required' => true,
            )),
            new Entity\IntegerField("ID_COLUMN", array(
                'required' => true,
            ))
        );
    }
    
    
}