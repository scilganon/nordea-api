<?php

use Profit\Nordea\API\Config;

require __DIR__ . '/../../bootstrap.php';

/**
 * @var Config $config
 */

$client = new \Profit\Nordea\API\Services\ClientRPCProxy($config);

$req = new \Profit\Nordea\API\SoapTypes\DownloadFileListRequest($config, '11111111A1');


$req->getRawApplicationRequest()->start_date = date('Y-m-d', time());
$req->getRawApplicationRequest()->end_date = date('Y-m-d', strtotime('-5 days'));

print_r($client->downloadFileList($req));