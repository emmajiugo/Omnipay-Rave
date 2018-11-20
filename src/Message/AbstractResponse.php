<?php
/**
 * Rave Response
 */

namespace Omnipay\Rave\Message;

/**
 * Rave Response
 *
 * This is the response class for all Rave requests.
 *
 * @see \Omnipay\Rave  \Gateway
 */
class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    /**
     * Get a token, for createCard requests.
     *
     * @return string|null
     */
    public function getTransactionReference()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }

        return null;

    }

    /**
     * Get the error message from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getMessage()
    {
        if (!$this->isSuccessful() && isset($this->data['errorCode'])) {
            return $this->data['errorCode'] . ': ' . $this->data['message'];
        }

        return null;
    }

    /**
     * Is the transaction successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return !isset($this->data['errorCode']);
    }
}
