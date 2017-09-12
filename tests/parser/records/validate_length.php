<?php

require __DIR__ . '/../../bootstrap.php';

if(!\Profit\Nordea\API\Parser\TITORecords\BasicAccountStatement::validateMaxLength()){
    echo 'not equal max length with expected for ' . \Profit\Nordea\API\Parser\TITORecords\BasicAccountStatement::class;
}

if(!\Profit\Nordea\API\Parser\TITORecords\BasicAccountTransactionRecord::validateMaxLength()){
    echo 'not equal max length with expected for ' . \Profit\Nordea\API\Parser\TITORecords\BasicAccountTransactionRecord::class;
}

echo 'Tests finished';

