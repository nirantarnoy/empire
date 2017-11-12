<?php

namespace backend\helpers;

class TransStatus
{
    const TRANS_DRAF = 1;
    const TRANS_CONFIRMED = 2;
    const TRANS_DELIVER = 3;
    const TRANS_CLOSED = 4;
    const TRANS_CANCEL = 5;
    
    private static $data = [
        1 => 'Open',
        2 => 'Confirmed',
        3 => 'Delivered',
        4 => 'Closed',
        5 => 'Cancel'
    ];

	private static $dataobj = [
        ['id'=>1,'name' => 'Open'],
        ['id'=>2,'name' => 'Confirmed'],
        ['id'=>3,'name' => 'Delivered'],
        ['id'=>4,'name' => 'Closed'],
        ['id'=>5,'name' => 'Cancel'],
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
