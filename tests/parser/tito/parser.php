<?php

require __DIR__ . '/../../bootstrap.php';

$parser = new Profit\Nordea\API\Parser\TITOParser();

$content = file_get_contents(__DIR__ . '/source.tito.txt');

print_r($parser->parseFileContent($content));