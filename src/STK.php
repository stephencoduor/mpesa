<?php

namespace Stephencoduor\Mpesa;

class STK extends Service
{
    public function __construct(array $config)
    {
        $this->security_credential   = $this->security_credential();
        parent::__construct($config);


    }


    /** STK Push lipa na M-pesa Online payment API is used to initiate a M-pesa transaction on behalf of a customer using STK push
     * This is the same technique mySafaricom app uses whenever the app is used to make payments
     *
     * @param  int     $amount
     * @param  int     $PartyA | The MSISDN sending the funds.
     * @param  int     $AccountReference  | (order id) Used with M-Pesa PayBills
     * @param  string  $TransactionDesc | A description of the transaction.
     * @return array object
     */

    public function stk($Amount, $PartyA, $AccountReference, $TransactionDesc)
    {
        $url =  $this->env('mpesa/stkpush/v1/processrequest');

        //Fill in the request parameters with valid values
        $curl_post_data = array(
            'BusinessShortCode' => $this->shortcode,
            'Password' => $this->password(),
            'Timestamp' => $this->timestamp(),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $PartyA,
            'CallBackURL' => $this->callback_url,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc
        );

        $this->query($url, $curl_post_data);
    }

    /** STK Push Status Query
     * This is used to check the status of a Lipa Na M-Pesa Online Payment.
     *
     * @param   string  $checkoutRequestID | Checkout RequestID
     * @return  array object
     */
    public function StkPushQuery($checkoutRequestID)
    {
        $url =  $this->env('mpesa/stkpushquery/v1/query');

        //Fill in the request parameters with valid values
        $curl_post_data = array(
            'BusinessShortCode' => $this->shortcode,
            'Password'  => $this->password(),
            'Timestamp' => $this->timestamp(),
            'CheckoutRequestID' => $checkoutRequestID
        );

        $this->query($url, $curl_post_data);
    }


}