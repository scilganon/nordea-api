<?php


namespace Profit\Nordea\API\Parser\TITORecords;


use function Funct\Collection\flattenAll;

class BalanceRecord extends Record
{
    static public function getMap()
    {
        return [
            'fileId' => 1,
            'recordCode' => 2,
            'length' => 3,
            'publishDate' => 6,
            'entryDateClosingBalance' => [
                'sign' => 1,
                'amount' => 18
            ],
            'availableBalance' => [
                'sign' => 1,
                'amount' => 18
            ],
        ];
    }

    static public function getCode()
    {
        return '40';
    }

    static public function validateMaxLength()
    {
        return array_sum(flattenAll(self::getMap())) === 322;
    }
}
