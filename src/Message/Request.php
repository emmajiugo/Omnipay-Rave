<?php
/**
 * Rave Gateway Request
 */

namespace Omnipay\Rave\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * Rave Gateway Request
 */
class Request extends AbstractRequest
{

    /**
     * Live or Test Endpoint URL.
     *
     * @var string URL
     */
    protected $testEndpoint = 'https://ravesandboxapi.flutterwave.com';
    protected $liveEndpoint = 'https://api.ravepay.co';

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
    public function getData()
    {
        $this->validate('amount');

        return $this->getParameters();
    }

    public function sendData($data)
    {
        return $this->response = new Response($this, $data);
    }
}
