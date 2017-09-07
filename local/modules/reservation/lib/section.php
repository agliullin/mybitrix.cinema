<?php
namespace Cinema\Reservation;

use Bitrix\Main\Entity;

class SectionTable extends Entity\DataManager
{
    public static function getFilePath()
    {
        return __FILE__;
    }

    public static function getTableName() {
        return "reservation_section";
    }
    
    public static function getMap() {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true,
            )),
            new Entity\StringField('NAME', array(
                'required' => true,
            ))
        );
    }
}