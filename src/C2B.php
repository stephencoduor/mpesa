<?php

namespace Stephencoduor\Mpesa;

class C2B extends Mpesa
{

    public function __construct()
    {
//        $this->security_credential   = $this->security_credential();
        parent::__construct();


    }


    /** C2B enable Paybill and buy goods merchants to integrate to mpesa and receive real time payment notification
     *  C2B register URL API register the 3rd party's confirmation and validation url to mpesa
     *  which then maps these URLs to the 3rd party shortcode whenever mpesa receives atransaction on the shortcode
     *  Mpesa triggers avalidation request against the validation URL and the 3rd party system responds to mpesa
     *  with a validation response (eithera success or an error code)
     *
     *  @return json
     */
    public function register_url($confirmation_url,$validation_url)
    {
        $url =  $this->env('mpesa/c2b/v1/registerurl');

        //Fill in the request parameters with valid values
        $curl_post_data = array(
            'ShortCode' => $this->shortcode1,
            'ResponseType' => 'Completed',
            'ConfirmationURL' => $confirmation_url,
            'ValidationURL' => $validation_url
        );

        $this->query($url, $curl_post_data);
    }


    /** C2B  transaction
     *
     * @param  int   $Amount | The amount been transacted.
     * @param  int   $Msisdn | MSISDN (phone number) sending the transaction, start with country code without the plus(+) sign.
     * @param  int   $BillRefNumber | Bill Reference Number (Optional).
     * @return array object
     */
    public function c2bPay($Amount, $Msisdn, $BillRefNumber = NULL)
    {
        $url =  $this->env('mpesa/c2b/v1/simulate');

        //Fill in the request parameters with valid values
        $curl_post_data = array(
            'ShortCode'  => $this->shortcode,
            'CommandID'  => $this->TransactionType,
            'Amount'     => $Amount,
            'Msisdn'     => $Msisdn,
            'BillRefNumber' => $BillRefNumber  // '00000' //optional
        );

        $this->query($url, $curl_post_data);
    }

}
