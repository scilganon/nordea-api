<?php

require_once __DIR__ . '/../vendor/autoload.php';

$key_file = realpath('/home/Projects/nordea/ruby_proxy/cert/client/nor_gc_20171004.pem');

$config = new \Profit\Nordea\API\Config();
$config->language = 'EN';
$config->environment = 'PRODUCTION';
$config->user_agent = 'Ruby';
$config->software_id = 'Ruby';
$config->cert_file = $key_file;
$config->private_key_file = $key_file;
$config->sender_id = 8224576917;
$config->customer_id = 8224576917;
$config->receiver_id = 123456789;

