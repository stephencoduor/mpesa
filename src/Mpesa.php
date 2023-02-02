<?php

namespace Stephencoduor\Mpesa;

use Exception;
use GuzzleHttp\Exception\BadResponseException;
use Stephencoduor\Mpesa\C2B;
use Stephencoduor\Mpesa\STK;
use Stephencoduor\Mpesa\B2C;
use Stephencoduor\Mpesa\B2B;
use Illuminate\Support\Facades\Config;



date_default_timezone_set("Africa/Nairobi");

/**----------------------------------------------------------------------------------------
| Mpesa Api library
|------------------------------------------------------------------------------------------
| *
| * @package     service class
| * @author      stephen Oduor
| * @email       stephencoduor@gmail.com
| * @website     http://itbrains.info
| * @version     1.0
| * @license     MIT License Copyright (c) 2021 IT BRAINS LTD
| *--------------------------------------------------------------------------------------- 
| *---------------------------------------------------------------------------------------
 */

class Mpesa
{

    public string $security_credential;

    private  $msg = [];
    /**
     * @var mixed|string
     */
    private string $token;


    //public string $SecurityCredential;
    protected string  $consumer_key;
    protected string  $consumer_secret;
    protected string  $shortcode;
    protected string  $store;
    protected string $pass_key;
    protected string $transactionType;
    protected string $sandbox_endpoint;
    public string $environment;


    public function __construct() {
        $this->setConsumerkey();
        $this->setSecretkey();
        $this->setShortcode();
        $this->setPasskey();
        $this->setStore();
        $this->setEnvironment();
        $this->setInitiatorName();
        $this->setInitiatorPassword();
        $this->setTransactionType();

        $this->live_endpoint      = 'https://api.safaricom.co.ke/';
        $this->sandbox_endpoint   = 'https://sandbox.safaricom.co.ke/';
    }

    public function setConsumerkey(){$this->consumer_key = Config::get('publicKey');}
    public function setSecretkey(){$this->consumer_secret = Config::get('secretKey');}
    public function setShortcode(){$this->shortcode = Config::get('shortcode');}
    public function setPasskey(){$this->pass_key = Config::get('passKey');}
    public function setStore(){$this->store = Config::get('store');}
    public function setEnvironment(){$this->environment = Config::get('environment');}
    public function setInitiatorName(){$this->initiator_name = Config::get('initiatorName');}
    public function setInitiatorPassword(){$this->initiator_pass = Config::get('initiatorPassword');}
    public function setTransactionType(){$this->transactionType = Config::get('transactionType');}



    public function Express()
    {
        return new STK($this);
    }

    public function c2b()
    {
        return new C2B($this);
    }

    public function b2c()
    {
        return new B2C($this);
    }

    public function b2b()
    {
        return new B2B($this);
    }

  /**
   * Mpesa configuration function
   * 
   * @param $key
   * @param $value
   * 
   * @return object
   */


  /** To authenticate your app and get an Oauth access token
   * An access token expires in 3600 seconds or 1 hour
   *
   * @access   private
   * @return   array object
   */
  public function oauth_token($token =NULL)
  {
      if (is_null($token)) {

          try {
              $url = $this->env('oauth/v1/generate?grant_type=client_credentials');
              $curl = curl_init();
              curl_setopt($curl, CURLOPT_URL, $url);
              $credentials = base64_encode($this->consumer_key . ':' . $this->consumer_secret);

              //setting a custom header
              curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); //setting a custom header
              curl_setopt($curl, CURLOPT_HEADER, false);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

              $curl_response = curl_exec($curl);

              if ($curl_response == true) {
                  //return json_decode($curl_response)->access_token;
                  $this->token = json_decode($curl_response)->access_token;
                  //Cache::put('mpesa_token', $curl_response['access_token'], now()->addSeconds(58));
              } else {
                  return curl_error($curl);
              }

          }catch (BadResponseException $e) {
              throw $e;
          }catch (Exception $e) {
              throw $e;
          }
      }
      else {
            $this->token = $token;
        }



}

  /** Account Balance API request for account balance of a shortcode
   * 
   * @access  public
   * @param   int     $PartyA | Type of organization receiving the transaction
   * @param   int     $IdentifierType |Type of organization receiving the transaction
   * @param   string  $Remarks | Comments that are sent along with the transaction.
   * @return  array object
   */
  public function accountbalance($PartyA, $IdentifierType, $Remarks, $timeout_url, $result_url)
  {
    $url =  $this->env('mpesa/accountbalance/v1/query');

    //Fill in the request parameters with valid values
    $curl_post_data = array(
      'Initiator' => $this->initiator_name,
      'SecurityCredential' => $this->SecurityCredential,
      'CommandID' => 'AccountBalance',
      'PartyA' => $PartyA,
      'IdentifierType' => $IdentifierType,
      'Remarks' => $Remarks,
      'QueueTimeOutURL' => $this->timeout_url . $timeout_url,
      'ResultURL' => $this->result_url . $result_url
    );

    $this->query($url, $curl_post_data);
  }

  /** reverses a B2B ,B2C ir C2B Mpesa,transaction
   *
   * @access  public
   * @param   int      $amount
   * @param   int      $ReceiverParty
   * @param   int      $TransactionID
   * @param   int      $RecieverIdentifierType
   * @param   string   $Remarks
   * @param   string   $Ocassion
   * @return  string
   */
  public function reversal($Amount, $ReceiverParty, $RecieverIdentifierType, $TransactionID, $Remarks,
                           $Occasion = NULL, $timeout_url, $result_url)
  {
    $url =  $this->env('mpesa/reversal/v1/request');

    //Fill in the request parameters with valid values      
    $curl_post_data = array(
      'Initiator' => $this->initiator_name,
      'SecurityCredential' => $this->SecurityCredential,
      'CommandID' => 'TransactionReversal',
      'TransactionID' => $TransactionID,
      'Amount' => $Amount,
      'ReceiverParty' => $ReceiverParty,
      'RecieverIdentifierType' => $RecieverIdentifierType, //4
      'ResultURL' => $this->result_url . $result_url,
      'QueueTimeOutURL' => $this->timeout_url . $timeout_url,
      'Remarks' => $Remarks,
      'Occasion' => $Occasion
    );

    $this->query($url, $curl_post_data);
  }


  /** Transaction Status Request API checks the status of B2B ,B2C and C2B APIs transactions
   *
   * @access  public
   * @param   string  $TransactionID | Organization Receiving the funds.
   * @param   int     $PartyA | Organization/MSISDN sending the transaction
   * @param   int     $IdentifierType | Type of organization receiving the transaction
   * @param   string  $Remarks
   * @param   string  $Ocassion
   * @return array object
   */
  public function transaction_status($TransactionID, $PartyA, $IdentifierType, $Remarks, $Occassion = NULL, $timeout_url, $result_url)
  {
    $url =  $this->env('mpesa/transactionstatus/v1/query');

    //Fill in the request parameters with valid values
    $curl_post_data = array(
      'Initiator' => $this->initiator_name,
      'SecurityCredential' => $this->SecurityCredential,
      'CommandID' => 'TransactionStatusQuery',
      'TransactionID' => $TransactionID,
      'PartyA' => $PartyA,
      'IdentifierType' => $IdentifierType,
      'ResultURL' => $this->result_url . $result_url,
      'QueueTimeOutURL' => $this->timeout_url . $timeout_url,
      'Remarks' => $Remarks,
      'Occasion' => $Occassion
    );

    $this->query($url, $curl_post_data);
  }




    /** query function
     *
     * @param  $url
     * @param  $curl_post_data
     * @return json
     */
    public function query($url, $curl_post_data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        //setting custom header
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array('Content-Type:application/json',
            'Authorization:Bearer ' . $this->oauth_token()));

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

        $curl_response = curl_exec($curl);
        if ($curl_response == true) {
            $this->msg = $curl_response;
        } else {
            $this->msg = curl_error($curl);
        }
    }

    /** get environment url
     *
     * @access public
     * @param  string $request_url
     * @return string
     */
     
    public function env($request_url = null)
    {
        if (!is_null($request_url)) {
            if ($this->environment === "sandbox") {
                return $this->sandbox_endpoint . $request_url;
            } elseif ($this->environment === "live") {
                return $this->live_endpoint . $request_url;
            }
        }
    }

    /** Password for encrypting the request.
     *  This is generated by base64 encoding Bussiness shorgcode passkey and timestamp
     *
     * @access  private
     * @return  string
     */
    public function password()
    {
        $Merchant_id =  trim($this->shortcode);
        $passkey     =  trim($this->pass_key);
        $password    =  base64_encode($Merchant_id . $passkey . $this->timestamp());

        return $password;
    }


    /**
     * timestamp for the time of transaction
     */
    public function timestamp()
    {
        return date('YmdHis');
    }

    /**
     * Mpesa authenticate a transaction by decrypting the security credential
     * Security credentials are generated by encrypting the Base64 encoded string of the M-Pesa short code
     * and password, which is encrypted using M-Pesa public key and validates the transaction on M-Pesa Core system.
     *
     * @access  private
     * @return  String
     */
    public function security_credential()
    {
        //$publicKey = file_get_contents(__DIR__ . '\cert.cert');
        //openssl_public_encrypt($this->initiator_pass, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);
        // return if(!is_null($this->security_credential))? $this->security_credential : base64_encode($encrypted);
        return $this->security_credential;
    }

    /**
     *  response on api call
     *
     *  @return data array or json
     */
    public function getResponseData($array = NULL)
    {
        if ($array == TRUE) {
            return json_decode($this->msg);
        }
        return json_decode($this->msg);
    }
}






