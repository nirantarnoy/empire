<?php

namespace backend\helpers;

class TransactionType
{
    const INCOME = 1;
    const EXPEND = 2;
    
    private static $data = [
        1 => 'รายจ่าย'
     //   2 => 'รายรับ'
    
    ];

	private static $dataobj = [
        ['id'=>1,'name' => 'รายจ่าย'],
      //  ['id'=>2,'name' => 'รายรับ'],

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
