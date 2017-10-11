<?php

use Profit\Nordea\API\Config;

require __DIR__ . '/../bootstrap.php';

/**
 * @var Config $config
 */

$client = new \Profit\Nordea\API\Services\ClientRPCProxy($config);

$req = new \Profit\Nordea\API\SoapTypes\DownloadFileRequest($config, '0006454783', [
    '1320171010004833'
]);

print_r($client->downloadFile($req));