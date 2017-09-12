<?php

namespace Profit\Nordea\API\SoapTypes;

class RequestHeader
{

    /**
     * @var string
     */
    public $SenderId = null;

    /**
     * @var string
     */
    public $RequestId = null;

    /**
     * @var \DateTime
     */
    public $Timestamp = null;

    /**
     * @var string
     */
    public $Language = null;

    /**
     * @var string
     */
    public $UserAgent = null;

    /**
     * @var string
     */
    public $ReceiverId = null;

    /**
     * @return string
     */
    public function getSenderId()
    {
        return $this->SenderId;
    }

    /**
     * @param string $SenderId
     */
    public function setSenderId($SenderId)
    {
        $this->SenderId = $SenderId;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->RequestId;
    }

    /**
     * @param string $RequestId
     */
    public function setRequestId($RequestId)
    {
        $this->RequestId = $RequestId;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->Timestamp;
    }

    /**
     * @param \DateTime $Timestamp
     */
    public function setTimestamp($Timestamp)
    {
        $this->Timestamp = $Timestamp;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->Language;
    }

    /**
     * @param string $Language
     */
    public function setLanguage($Language)
    {
        $this->Language = $Language;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->UserAgent;
    }

    /**
     * @param string $UserAgent
     */
    public function setUserAgent($UserAgent)
    {
        $this->UserAgent = $UserAgent;
    }

    /**
     * @return string
     */
    public function getReceiverId()
    {
        return $this->ReceiverId;
    }

    /**
     * @param string $ReceiverId
     */
    public function setReceiverId($ReceiverId)
    {
        $this->ReceiverId = $ReceiverId;
    }

    public function toArray()
    {
        return get_class_vars($this);
    }
}

