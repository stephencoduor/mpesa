<?php

namespace Stephencoduor\Mpesa;

class B2C extends Service
{

    public function __construct(array $config)
    {
        $this->security_credential   = $this->security_credential();
        parent::__construct($config);


    }

    /**
     * B2C Payment Request transactions betwwen a company and customers
     * who are the enduser of its products ir services
     * command id SalaryPayment,BussinessPayment ,PromotionPayment
     *
     * @param   int       $amount
     * @param   string    $commandId | Unique command for each transaction type e.g. SalaryPayment, BusinessPayment, PromotionPayment
     * @param   string    $receiver  | Phone number receiving the transaction
     * @param   string    $remark    | Comments that are sent along with the transaction.
     * @param   string    $ocassion  | optional
     * @return  array object
     */
    public function b2c($amount, $commandId, $receiver, $remark, $occassion = null, $timeout_url, $result_url)
    {
        $url = $this->env('mpesa/b2c/v1/paymentrequest');

        //Fill in the request parameters with valid values
        $curl_post_data = array(
            'InitiatorName'      => $this->initiator_name,
            'SecurityCredential' => $this->SecurityCredential,
            'CommandID' => $commandId,
            'Amount' => $amount,
            'PartyA' => $this->shortcode1,
            'PartyB' => $receiver,
            'Remarks' => $remark,
            'QueueTimeOutURL' => $this->timeout_url . $timeout_url,
            'ResultURL' => $this->result_url . $result_url,
            'Occasion' => $occassion
        );

        $this->query($url, $curl_post_data);
    }


}