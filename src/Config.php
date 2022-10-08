<?php

namespace Stephencoduor\Mpesa;

use Exception;

class Config
{

    //public string $SecurityCredential;
    protected string  $consumer_key;
    protected string  $consumer_secret;
    protected string  $shortcode;
    protected string  $store;
    protected string $pass_key;
    protected string $initiator_name;
    protected string $initiator_pass;
    protected string $security_credential;
    protected string $TransactionType;
//    protected string $timeout_url;
//    protected string $validation_url;
//    protected string $callback_url;
//    protected string $result_url;
    protected string $live_endpoint;
    protected string $sandbox_endpoint;

    public bool $environment;

    protected function __construct(array $config) {


        if(isset($config['consumer_key'])) {
            $this->consumer_key  = $config['consumer_key'];
        } else {
            throw new Exception('Missing  Parameter consumer_key"', 400);
        }
        if(isset($config['consumer_secret'])) {
            $this->consumer_secret  = $config['consumer_secret'];
        } else {
            throw new Exception('Missing parameter "consumer_secret"', 400);
        }

        if(isset($config['pass_key'])) {
            $this->pass_key   = $config['pass_key'];
        } else {
            throw new InvalidRequestException('Missing parameter "pass_key"', 400);
        }

        $this->shortcode      = (isset($config['shortcode'])) ? $config['shortcode'] :null;
        $this->initiator_name      = (isset($config['initiator_name'])) ? $config['initiator_name'] :null;
        $this->initiator_pass      = (isset($config['initiator_pass'])) ? $config['initiator_pass'] :null;
        $this->store      = (isset($config['store'])) ? $config['store'] :null;
        $this->TransactionType      = (isset($config['TransactionType'])) ? $config['TransactionType'] :null;

//        $this->callback_url      = (isset($config['callback_url'])) ? $config['callback_url'] :null;
//        $this->confirmation_url      = (isset($config['confirmation_url'])) ? $config['confirmation_url'] :null;
//        $this->timeout_url      = (isset($config['timeout_url'])) ? $config['timeout_url'] :null;
//        $this->validation_url      = (isset($config['validation_url'])) ? $config['validation_url'] :null;
//        $this->result_url      = (isset($config['result_url'])) ? $config['result_url'] :null;
        
        $this->environment      = (isset($config['environment'])) ? $config['$environment'] :true;
        $this->live_endpoint      = 'https://api.safaricom.co.ke/';
        $this->sandbox_endpoint   = 'https://sandbox.safaricom.co.ke/';


    }



    public function get($name)
    {
        if (isset($this->settings[$name])) {
            return $this->settings[$name];
        } else {
            return (NULL);
        }
    }

    public function set($name, $value)
    {
        //update only if different from what
        //we already have
        if (
            !isset($this->settings[$name]) or ($this->settings[$name] != $value)
        ) {
            $this->settings[$name] = $value;
            $this->updated = TRUE;
        }
    }




}
