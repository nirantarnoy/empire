<?php

namespace backend\helpers;

class TaskInterval
{
    const TASK_7 = 7;
    const TASK_15 = 15;
    const TASK_30 = 30;
    const TASK_90 = 90;
    const TASK_180 = 180;
    const TASK_365 = 365;
   
    
    private static $data = [
        7 => '7 วัน',
        15 => '15 วัน',
        30 => '1 เดือน',
        90 => '3 เดือน',
        180 => '6 เดือน',
        365=> '1 ปี'
    ];

	private static $dataobj = [
        ['id'=>7,'name' => '7 วัน'],
        ['id'=>15,'name' => '15 วัน'],
        ['id'=>30,'name' => '1 เดือน'],
        ['id'=>90,'name' => '3 เดือน'],
        ['id'=>180,'name' => '6 เดือน'],
        ['id'=>365,'name' => '1 ปี'],
    ];
    public static function asArray()
    {
        return self::$data;
    }
     public static function asArrayObject()
    {
        return self::$dataobj;
    }
    public static function getTypeById($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
}
