<?php

namespace backend\helpers;

class ExpenseType
{
    const EXPENSE_MARKET = 1;
    const EXPENSE_CAR = 2;
    const EXPENSE_PEOPLE = 3;
    const EXPENSE_OTHER = 4;
    
    private static $data = [
        1 => 'ที่',
        2 => 'รถ',
        3 => 'เด็ก',
        4 => 'อื่นๆ'
    ];

	private static $dataobj = [
        ['id'=>1,'name' => 'ที่'],
        ['id'=>2,'name' => 'รถ'],
        ['id'=>3,'name' => 'เด็ก'],
        ['id'=>4,'name' => 'อื่นๆ'],
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
