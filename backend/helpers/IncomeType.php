<?php

namespace backend\helpers;

class IncomeType
{
    const INCOME_CASH = 1;
    const INCOME_DEP = 2;
    const INCOME_TRN = 3;
    
    private static $data = [
        1 => 'เงินสด',
        2 => 'เงินฝาก',
        3 => 'เงินโอน'
       
    ];

	private static $dataobj = [
        ['id'=>1,'name' => 'เงินสด'],
        ['id'=>2,'name' => 'เงินฝาก'],
        ['id'=>3,'name' => 'เงินโอน'],
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
