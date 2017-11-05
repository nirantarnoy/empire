<?php

namespace backend\helpers;

class PaymentType
{
    const PAYMENT_TYPE_CASH = 1;
    const PAYMENT_TYPE_BANK_TRANSFER = 2;
    const PAYMENT_TYPE_CREDIT_CARD = 3;
    
    private static $data = [
        1 => 'เงินสด',
        2 => 'โอนธนาคาร',
        3 => 'บัตรเครดิต'
    ];

	private static $dataobj = [
        ['id'=>1,'name' => 'เงินสด'],
        ['id'=>2,'name' => 'โอนธนาคาร'],
        ['id'=>3,'name' => 'บัตรเครดิต'],
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
