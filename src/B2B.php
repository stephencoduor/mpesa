<?php

namespace Stephencoduor\Mpesa;

class B2B extends Mpesa
{
    public function __construct(array $config)
    {
        $this->security_credential   = $this->security_credential();
        parent::__construct($config);


    }

    /** B2B Payment Request transactions between a business and another business
     * Api requires a valid and verifiedB2B Mpesa shortcode for the business initiating the transaction
     * andthe bothbusiness involved in the transaction
     * Command ID : BussinessPayBill ,MerchantToMerchantTransfer,MerchantTransferFromMerchantToWorking,MerchantServucesMMFAccountTransfer,AgencyFloatAdvance
     *
     * @param  int      $Amount
     * @param  string   $commandId
     * @param  int      $PartyB | Organization’s short code receiving the funds being transacted.
     * @param  int      $SenderIdentifierType | Type of organization sending the transaction. 1,2,4
     * @param  int      $RecieverIdentifierType | Type of organization receiving the funds being transacted. 1,2,4
     * @param  string   $AccountReference | Account Reference mandatory for “BusinessPaybill” CommandID.
     * @param  string   $remarks
     * @return array    object
     */
    public function b2bSend($Amount, $commandId, $PartyB, $RecieverIdentifierType, $SenderIdentifierType, $AccountReference, $Remarks, $timeout_url,
                            $result_url)
    {
        $url =  $this->env('/mpesa/b2b/v1/paymentrequest');

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'Initiator' => $this->initiator_name,
            'SecurityCredential' => $this->SecurityCredential,
            'CommandID' => $commandId,
            'SenderIdentifierType' => $SenderIdentifierType,
            'RecieverIdentifierType' => $RecieverIdentifierType,
            'Amount' => $Amount,
            'PartyA' => $this->shortcode1,
            'PartyB' => $PartyB,
            'AccountReference' => $AccountReference,
            'Remarks' => $Remarks,
            'QueueTimeOutURL' => $timeout_url,
            'ResultURL' => $result_url
        );

        $this->query($url, $curl_post_data);
    }

}