<?php


namespace Profit\Nordea\API\Parser\TITORecords;


use function Funct\Collection\flattenAll;

class BasicAccountTransactionRecord extends Record
{
    static public function getMap()
    {
        return [
            'fileId' => 1,
            'recordCode' => 2,
            'length' => 3,
            'transactionNumber' => 6,
            'fillingCode' => 18,
            'publishDate' => 6,
            'valueDate' => 6,
            'paymentDate' => 6,
            'transactionCode' => 1, //1-4
            'entryDefinition' => [
                'code' => 3,
                'definitionText' => 35
            ],
            'amountOfTransaction' => [
                'sign' => 1,
                'amount' => 18 //16+2
            ],
            'receiptCode' => 1, //<empty>/E/K,
            'transmissionMethod' => 1,
            'creditorOrDebtor' => [
                'name' => 35,
                'sourceOfName' => 1
            ],
            'creditorsAccount' => [
                'accountNumber' => 14,
                'changeOfAccountMsg' => 1
            ],
            'reference' => 20,
            'formNumber' => 8,
            'lvlCode' => 1 //<empty>/1/2
        ];
    }

    static public function getCode()
    {
        return '10';
    }

    static public function validateMaxLength()
    {
        return array_sum(flattenAll(self::$map)) === 188;
    }
}