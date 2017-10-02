<?php

use Verdant\XML2Array;

require_once __DIR__ . '/../../bootstrap.php';

$data = file_get_contents(__DIR__ . '/data.xml');

print_r(XML2Array::createArray($data));