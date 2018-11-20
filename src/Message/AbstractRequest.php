<?php
/**
 * Rave Abstract Request
 */

namespace Omnipay\Rave\Message;

/**
 * Rave Abstract Request
 *
 * This is the parent class for all Rave requests.
 *
 * You can use any of the cards listed at
 * https://developer.flutterwave.com/v2.0/reference#test-cards-1
 * for testing.
 *
 * @see \Omnipay\Rave\Gateway
 * @link https://api.ravepay.co
 * @link https://ravesandboxapi.flutterwave.com
 * @method \Omnipay\Rave\Message\Response send()
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Live or Test Endpoint URL
     *
     * @var string URL
     */
    protected $liveEndpoint = 'https://api.ravepay.co';
    protected $testEndpoint = 'https://ravesandboxapi.flutterwave.com';

    public function getSecretApiKey()
    {
        return $this->getParameter('secretApiKey');
    }

    public function setSecretApiKey($value)
    {
        return $this->setParameter('secretApiKey', $value);
    }

    public function getPublicApiKey()
    {
        return $this->getParameter('publicApiKey');
    }

    public function setPublicApiKey($value)
    {
        return $this->setParameter('publicApiKey', $value);
    }

    public function getMetadata()
    {
        return $this->getParameter('metadata');
    }

    public function setMetadata($value)
    {
        return $this->setParameter('metadata', $value);
    }

    // public function getUdf()
    // {
    //     return $this->getParameter('udf');
    // }

    // public function getUdfValues()
    // {
    //     if ($udf = $this->getUdf()) {
    //         return array_values($udf);
    //     }

    //     return false;
    // }

    // public function setUdf($value)
    // {
    //     return $this->setParameter('udf', $value);
    // }

    // public function setCardToken($value)
    // {
    //     return $this->setParameter('cardToken', $value);
    // }

    // public function getCardToken()
    // {
    //     return $this->getParameter('cardToken');
    // }

    // public function setEmail($value)
    // {
    //     return $this->setParameter('email', $value);
    // }

    // public function getEmail()
    // {
    //     return $this->getParameter('email');
    // }

    // public function setCustomerName($value)
    // {
    //     return $this->setParameter('customerName', $value);
    // }

    // public function getCustomerName()
    // {
    //     return $this->getParameter('customerName');
    // }

    public function sendRequest($data)
    {
        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            null,
            !empty($data) ? json_encode($data) : null
        );

        $httpRequest
            ->setHeader('Content-Type', 'application/json;charset=UTF-8')
            ->setHeader('Accept', 'application/json');
            // ->setHeader('Authorization', $this->getSecretApiKey());

        return $httpRequest->send();
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    public function getEndpoint()
    {
        if ($this->getTestMode()) {
            return $this->testEndpoint;
        }

        return $this->liveEndpoint;
    }

}
