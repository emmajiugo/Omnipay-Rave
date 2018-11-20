<?php

namespace Omnipay\Rave;

use Omnipay\Common\AbstractGateway;

/**
 * Rave Gateway
 */
class Gateway extends AbstractGateway
{
    /**
     * Get name of the gateway
     *
     * @return string
     */
    public function getName()
    {
        return 'Rave';
    }

    public function getDefaultParameters()
    {
        return array(
            'secretApiKey' => '',
            'publicApiKey' => '',
            'testMode' => false,
        );
    }

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


    // public function authorize(array $parameters = array())
    // {
    //     return $this->createRequest('\Omnipay\Rave\Message\Request', $parameters);
    // }

    // this function is for CHARGE
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Rave\Message\PurchaseRequest', $parameters);
    }

    //this function is for VERIFY
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Rave\Message\CompletePurchaseRequest', $parameters);
    }

}
