<?php
/**
 * Rave Response
 */

namespace Omnipay\Rave\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Rave Response
 *
 * This is the response class for all Rave charge requests.
 *
 * @see \Omnipay\Rave\Gateway
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $redirectEndpoint = null;

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return !isset($this->data['errorCode']);
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectUrl()
    {
        if ($this->isRedirect()) {
            return 'placeholder';
        }
    }

    public function getRedirectData()
    {
        return $this->getData();
    }
}
