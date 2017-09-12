<?php


namespace Profit\Nordea\API\Parser\TITORecords;


use function Funct\Collection\flattenAll;

class CumulativeCorrectionRecord extends Record
{
    static public function getMap()
    {
        return [
            'fileId' => 1,
            'recordCode' => 2,
            'length' => 3,
            'periodId' => 1, //1
            'periodDay' => 6,
            'transactions' => [
                'deposits' => [
                    'number' => 8,
                    'sum' => [
                        'sign' => 1,
                        'amount' => 18
                    ]
                ],
                'withdrawals' => [
                    'number' => 8,
                    'sum' => [
                        'sign' => 1,
                        'amount' => 18
                    ]
                ]
            ]
        ];
    }

    static public function getCode()
    {
        return '51';
    }

    static public function validateMaxLength()
    {
        return array_sum(flattenAll(self::$map)) === 67;
    }
}