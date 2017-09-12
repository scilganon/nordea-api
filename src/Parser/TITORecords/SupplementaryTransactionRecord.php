<?php


namespace Profit\Nordea\API\Parser\TITORecords;


class SupplementaryTransactionRecord extends ASupplementaryRecord
{

    static public function getCode()
    {
        return '11';
    }
}