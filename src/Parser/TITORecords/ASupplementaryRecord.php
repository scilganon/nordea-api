<?php


namespace Profit\Nordea\API\Parser\TITORecords;


use function Funct\Collection\flattenAll;

abstract class ASupplementaryRecord extends Record
{
    static public function getMap()
    {
        return [
            'fileId' => 1,
            'recordCode' => 2,
            'length' => 3,
            'typeOfSupplementaryData' => 2,
            'supplementaryData' => 0
        ];
    }

    static public function validateMaxLength()
    {
        return array_sum(flattenAll(self::getMap())) === 194;
    }
}