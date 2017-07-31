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
        return isset($this->data['queryId']) && $this->data['queryId'] === '00';
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
        // 訂單請求過銀聯后必須用origRespCode來判斷支付是否成功
        if (isset($this->data['origRespCode'])) {
            if ($this->data['origRespCode'] === '00') {
                return true;
            } else {
                return false;
            }
        }

        // 訂單沒有請求過銀聯用respCode來判斷支付是否成功
        return isset($this->data['respCode']) && $this->data['respCode'] === '00';
    }

    public function getMessage()
    {
        // 訂單請求過銀聯后必須用origRespMsg獲取支付信息
        return isset($this->data['origRespMsg']) ? $this->data['origRespMsg'] : $this->data['respMsg'];
    }
}
