<?php

namespace Profit\Nordea\API\Parser\TITORecords;


interface RecordInterface
{
    static public function getCode();

    static public function getMap();
}