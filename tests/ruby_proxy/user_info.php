<?php

require_once __DIR__ . '/../bootstrap.php';

use \JsonRPC\Client;
use Profit\Nordea\API\Config;


$client = new Client('http://0.0.0.0:8999');
print_r($client->execute('get_user_info', [
    'iConfig' => [
        'language' => "EN",
        'environment' => "PRODUCTION",
        'user_agent' => "Ruby",
        'software_id' => "Ruby",
        'sender_id' => 11111111,
    ],
    'iHeader' => [
        'receiver_id' => 123456789
    ],
    'iRequest' => [
        'customer_id' => 162355330
    ]
]));