<?php
/**
 * Rave Gateway Response
 */

namespace Omnipay\Rave\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Rave Gateway Response
 */
class Response extends AbstractResponse
{

    protected $headers = [];

    public function __construct(RequestInterface $request, $data, $headers = [])
    {
        $this->request = $request;
        $this->data = json_decode($data, true);
        $this->headers = $headers;
    }
    
    public function isSuccessful()
    {
        return true;
    }
}
