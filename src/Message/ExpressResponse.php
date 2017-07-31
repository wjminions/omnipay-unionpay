<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class ExpressResponse
 * @package Omnipay\UnionPay\Message
 */
class ExpressResponse extends AbstractResponse
{
    public function isRedirect()
    {
        return false;
    }


    public function getRedirectMethod()
    {
        return 'POST';
    }


    public function getRedirectUrl()
    {
        return false;
    }


    public function getRedirectHtml()
    {
        return false;
    }


    public function getTransactionNo()
    {
        return isset($this->data['queryId']) && $this->data['queryId'] == '00';
    }

    public function getDate()
    {
        return $this->data;
    }


    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        if (isset($this->data['origRespCode'])) {
            if ($this->data['origRespCode'] == '00') {
                return true;
            } else {
                return false;
            }
        }

        return isset($this->data['respCode']) && $this->data['respCode'] == '00';
    }

    public function getMessage()
    {
        return isset($this->data['origRespMsg']) ? $this->data['origRespMsg'] : $this->data['respMsg'];
    }
}
