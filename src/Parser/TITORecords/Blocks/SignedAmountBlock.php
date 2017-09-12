<?php


namespace Profit\Nordea\API\Parser\TITORecords\Blocks;


class SignedAmountBlock
{
    static public function rule()
    {
        return [
            'sign' => 1,
            'amount' => 18 //16+2
        ];
    }
}