<?php
/**
 * Rave Purchase Request
 */

namespace Omnipay\Rave\Message;

/**
 * Rave Purchase Request
 *
 */
class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = array();
        $data['amount'] = $this->getAmountInteger();
        $data['currency'] = strtoupper($this->getCurrency());
        $data['email'] = 'e@x.com';
        // $data['description'] = $this->getDescription();
        // $data['metadata'] = $this->getMetadata();

        //use switch statement to switch set charge country base on currency
        switch ($data['currency']) {
            case 'KES':
                $data['country'] = 'KE';
                break;
            case 'GHS':
                $data['country'] = 'GH';
                break;
            case 'ZAR':
                $data['country'] = 'ZA';
                break;
            
            default:
                $data['country'] = 'NG';
                break;
        }

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest($data);

        return $this->response = new PurchaseResponse($this, $httpResponse->json());
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/flwv3-pug/getpaidx/api/charge';
    }
}
