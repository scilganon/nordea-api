<?php

use Profit\Nordea\API\Config;

require __DIR__ . '/../bootstrap.php';

/**
 * @var Config $config
 */

$client = new \Profit\Nordea\API\Services\ClientRPCProxy($config);

$req = new \Profit\Nordea\API\SoapTypes\DownloadFileRequest($config, '11111111A1', [
    '11111111A12006030819503000000051'
]);

print_r($client->downloadFile($req));