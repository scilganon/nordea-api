<?php


namespace Profit\Nordea\API\Parser\TITORecords;


use function Funct\Collection\flattenAll;

class MessageRecord extends Record
{
    public $lines = [];

    static public function getMap()
    {
        return [
            'fileId' => 1,
            'recordCode' => 2,
            'length' => 3,
            'bankGroupCode' => 3,
        ];
    }

    static public function getCode()
    {
        return '70';
    }

    static public function validateMaxLength()
    {
        return array_sum(flattenAll(self::getMap())) <= 489;
    }
}