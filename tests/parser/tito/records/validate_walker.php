<?php

require __DIR__ . '/../../../bootstrap.php';

array_walk_recursive(\Profit\Nordea\API\Parser\TITORecords\BasicAccountStatement::getMap(), function($val, $key){
    echo $key . '=>' . $val . PHP_EOL;
});