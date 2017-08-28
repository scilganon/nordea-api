<?php

namespace Profit\Nordea\API\SoapTypes;


use Phpro\SoapClient\Type\RequestInterface;
use Profit\Nordea\API\ApplicationRequest;
use Profit\Nordea\API\Config;
use Profit\Nordea\API\Helper;
use Profit\Nordea\API\SignedApplicationRequest;

class GetUserInfoRequest implements RequestInterface
{

    /**
     * @var Config
     */
    private $config;

    /** @var \DateTime  */
    private $timestamp;

    /** @var RequestHeader  */
    private $RequestHeader;

    /** @var SignedApplicationRequest  */
    private $ApplicationRequest;

    /**
     * GetUserInfoRequest constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->timestamp = new \DateTime();

        $this->setRequestHeader(new RequestHeader());
        $this->setApplicationRequest(new ApplicationRequest());
    }

    /**
     * @return RequestHeader
     */
    public function getRequestHeader()
    {
        return $this->RequestHeader;
    }

    /**
     * @param RequestHeader $rh
     */
    public function setRequestHeader(RequestHeader $rh)
    {
        Helper::copyAttributes($rh, $this->config, [
            'sender_id',
            'language',
            'user_agent',
            'receiver_id'
        ]);

        $rh->setTimestamp($this->timestamp);
        $rh->setRequestId(Helper::hexRandom());

        $this->RequestHeader = $rh;
    }

    /**
     * @return base64Binary
     */
    public function getApplicationRequest()
    {
        return base64_encode($this->ApplicationRequest->toDocument()->saveXML());
    }

    /**
     * @param ApplicationRequest $ap
     */
    public function setApplicationRequest(ApplicationRequest $ap)
    {
        Helper::copyAttributes($ap, $this->config, [
            'customer_id',
            'environment',
            'software_id'
        ]);

        $ap->command = 'GetUserInfo';
        $ap->timestamp = $this->timestamp;

        $this->ApplicationRequest = new SignedApplicationRequest($ap, $this->config);
    }
}

