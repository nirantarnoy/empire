<?php

namespace backend\helpers;

class TransactionStatus
{
    const TRANSACTION_OPEN = 1;
    const TRANSACTION_CONFIRMED = 2;
    const TRANSACTION_COMPLETED = 3;
    const TRANSACTION_CANCELED = 4;
    
    private static $data = [
        1 => 'Open',
        2 => 'Confirmed',
        3 => 'Completed',
        4 => 'Canceled'
    ];

	private static $dataobj = [
        ['id'=>1,'name' => 'Open'],
        ['id'=>2,'name' => 'Confirmed'],
        ['id'=>3,'name' => 'Completed'],
        ['id'=>4,'name' => 'Canceled'],
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
