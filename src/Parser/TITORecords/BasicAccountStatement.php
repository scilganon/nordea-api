<?php


namespace Profit\Nordea\API\Parser\TITORecords;


use function Funct\Collection\flattenAll;

class BasicAccountStatement extends Record
{
    static public function getMap()
    {
        return [
            'fileId' => 1,
            'recordCode' => 2,
            'length' => 3,
            'versionNumber' => 3,
            'accountNumber' => 14, //bban,
            'statementNumber' => 3,
            'statementPeriod' => [
                'firstDay' => 6,
                'lastDay' => 6,
            ],
            'creationTime' => [
                'date' => 6,
                'time' => 4,
            ],
            'customerId' => 17,
            'openingBalanceDate' => 6,
            'openingBalance' => [
                'sign' => 1,
                'amount' => 18
            ],
            'numberOfRecordsOnTheAccountStatement' => 6,
            'accountCurrencyCode' => 3,
            'nameOfTheAccount' => 30,
            'accountLimit' => 18, //16+2
            'accountHoldersName' => 35,
            'contactData1' => 40, //name of the bank,
            'contactData2' => 40, //branch number and name,
            'dataSpecificToBank1' => 30, //Group Account and the account number
            'dataSpecificToBank2' => 30 //Account number in IBAN format and account holding bank's BIC
        ];
    }

    static public function getCode()
    {
        return '00';
    }

    static public function validateMaxLength()
    {
        return array_sum(flattenAll(self::$map)) === 322;
    }
}