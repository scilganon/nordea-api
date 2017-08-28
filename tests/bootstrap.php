<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = new \Profit\Nordea\API\Config();
$config->language = 'EN';
$config->environment = 'PRODUCTION';
$config->user_agent = 'Ruby';
$config->software_id = 'Ruby';
$config->cert_file = __DIR__ . '/../cert/WSNDEA1234.pem';
$config->private_key_file = __DIR__ . '/../cert/WSNDEA1234.pem';
$config->sernder_id = 11111111;