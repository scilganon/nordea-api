<?php

namespace Profit\Nordea\API\SoapTypes;


use Phpro\SoapClient\Type\RequestInterface;
use Profit\Nordea\API\ApplicationRequest;
use Profit\Nordea\API\Config;
use Profit\Nordea\API\Helper;
use Profit\Nordea\API\SignedApplicationRequest;

/**
 * @todo: remove hardcoded values
 *
 * Class DownloadFileRequest
 * @package Profit\Nordea\API\SoapTypes
 */
class DownloadFileRequest implements RequestInterface
{

    /**
     * @var RequestHeader
     */
    private $RequestHeader = null;

    /**
     * @var base64Binary
     */
    private $ApplicationRequest = null;
    private $config;
    private $timestamp;
    private $rawApplicationRequest;

    private $type = 'TITO';
    private $status = 'ALL';
    private $references = [];

    /**
     * DownloadFileRequest constructor.
     * @param Config $config
     * @param array $references
     */
    public function __construct(Config $config, array $references)
    {
        $this->config = $config;
        $this->timestamp = new \DateTime();

        $this->setReferences($references);

        $this->setApplicationRequest(new ApplicationRequest());
        $this->setRequestHeader(new RequestHeader());
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
        $rh->setSenderId($this->config->sender_id);
        $rh->setLanguage($this->config->language);
        $rh->setUserAgent($this->config->user_agent);
        $rh->setReceiverId($this->config->receiver_id);

        $rh->setTimestamp($this->timestamp);
        $rh->setRequestId(Helper::hexRandom());

        $this->RequestHeader = $rh;
    }

    /**
     * @return base64Binary
     */
    public function getApplicationRequest()
    {
        return $this->ApplicationRequest;
    }

    /**
     * @param ApplicationRequest $ar
     * @internal param $ApplicationRequest
     */
    public function setApplicationRequest(ApplicationRequest $ar)
    {
        $ar->command = 'downloadFile';

        $ar->customer_id = $this->config->customer_id;
        $ar->environment = $this->config->environment;
        $ar->software_id = $this->config->software_id;
        $ar->timestamp = $this->timestamp;

        $ar->file_type = $this->type;
        $ar->status = $this->status;
        $ar->file_references = $this->references;
        $ar->target_id = '11111111A1';

        $this->ApplicationRequest=  new SignedApplicationRequest($ar, $this->config);
        $this->rawApplicationRequest = $ar;
    }

    /**
     * @return ApplicationRequest
     */
    public function getRawApplicationRequest()
    {
        return $this->rawApplicationRequest;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @param array $references
     * @throws \Exception
     */
    public function setReferences(array $references)
    {
        if(empty($references)){
            throw new \Exception('you should add ref for at least one target file');
        }

        $this->references = $references;
    }


}

