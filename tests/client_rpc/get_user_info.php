<?php

use Profit\Nordea\API\Config;

require __DIR__ . '/../bootstrap.php';

/**
 * @var Config $config
 */

$client = new \Profit\Nordea\API\Services\ClientRPCProxy($config);

$req = new \Profit\Nordea\API\SoapTypes\GetUserInfoRequest($config);

print_r($client->getUserInfo($req));