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

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return isset($this->data['respCode']) && $this->data['respCode'] == '00';
    }

    public function getMessage()
    {
        return isset($this->data['respMsg']) ? $this->data['respMsg'] : '';
    }
}
