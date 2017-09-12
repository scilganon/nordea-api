<?php


namespace Profit\Nordea\API\Parser\TITORecords;


use function Funct\Collection\flattenAll;
use Profit\Nordea\API\Parser\TITORecords\Blocks\SignedAmountBlock;

class SpecialRecord extends Record
{
    static public function getMap()
    {
        return [
            'fileId' => 1,
            'recordCode' => 2,
            'length' => 3,
            'bankGroupCode' => 3,
            'specialRecordCode' => 2,
            'interestPeriod' => 13, //YYMMDD-YYMMDD
            'deposit' => [
                'dataType' => 1,
                'averageBalance' => SignedAmountBlock::rule()
            ],
            'depositInterest' => [
                'dataType' => 1,
                'interestRate' => 7
            ],
            'credit' => [
                'dataType' => 1,
                'averageBalance' => SignedAmountBlock::rule()
            ],
            'creditInterest' => [
                'dataType' => 1,
                'interestRate' => 7
            ],
            'limitUtilisationRate' => [
                'dateType' => 1,
                'utilisationPercentage' => 7
            ],
            'permanentBalance' => [
                'dataType' => 1,
                'balance' => SignedAmountBlock::rule()
            ],
            'depositReferenceInterest' => [
                'dataType' => 1,
                'referenceRateName' => 35,
                'interestRate' => 7
            ],
            'creditReferenceInterest' => [
                'dataType' => 1,
                'referenceRateName' => 35,
                'interestRate' => 7
            ]
        ];
    }

    static public function getCode()
    {
        return '60';
    }

    static public function validateMaxLength()
    {
        return array_sum(flattenAll(self::getMap())) === 194;
    }
}