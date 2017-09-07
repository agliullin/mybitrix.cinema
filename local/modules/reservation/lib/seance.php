<?php
namespace Cinema\Reservation;

use Bitrix\Main\Entity;

class SeanceTable extends Entity\DataManager
{
    public static function getFilePath()
    {
        return __FILE__;
    }

    public static function getTableName() {
        return "reservation_seance";
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
            new Entity\IntegerField("ID_FILM", array(
                'required' => true,
            )),
            new Entity\DatetimeField("START_TIME", array(
                'required' => true,
            )),
            new Entity\StringField('SECTION_PRICES', array(
                'required' => true,
            ))
        );
    }
}