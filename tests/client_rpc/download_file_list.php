<?php

use Profit\Nordea\API\Config;

require __DIR__ . '/../bootstrap.php';

/**
 * @var Config $config
 */

$client = new \Profit\Nordea\API\Services\ClientRPCProxy($config);

$req = new \Profit\Nordea\API\SoapTypes\DownloadFileListRequest($config, '0006454783');

print_r($client->downloadFileList($req));