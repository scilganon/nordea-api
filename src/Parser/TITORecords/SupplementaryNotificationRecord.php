<?php


namespace Profit\Nordea\API\Parser\TITORecords;


class SupplementaryNotificationRecord extends ASupplementaryRecord
{

    static public function getCode()
    {
        return '81';
    }
}