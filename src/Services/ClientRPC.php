<?php


namespace Profit\Nordea\API;


use JsonRPC\Client;
use Profit\Nordea\API\SoapTypes\GetUserInfoRequest;

class ClientRPC
{
    /**
     * @var array
     */
    private $config;

    /**
     * ClientRPC constructor.
     */
    public function __construct(array $config = [], string $clientUrl = 'http://0.0.0.0:8999')
    {
        $this->config = $config;
        $this->client = new Client($clientUrl);
    }

    public function user_info(GetUserInfoRequest $request)
    {
        return $this->client->execute('get_user_info', [
            'config' => $this->config,
            'header' => $request->getRequestHeader(),
            'request' => $request,
        ]);
    }

}