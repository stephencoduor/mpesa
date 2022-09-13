<?php

namespace Stephencoduor\Mpesa;

class Config
{

    //public string $SecurityCredential;
    public string  $consumer_key;
    public string  $consumer_secret;
    public string  $shortcode;
    public string $pass_key;
    public string $initiator_name;
    public string $initiator_pass;
    public string $security_credential;
    public string $confirmation_url;
    public string $timeout_url;
    public string $validation_url;
    public string $callback_url;
    public string $result_url;
    public string $live_endpoint;
    public string $sandbox_endpoint;

    public bool $env;

    protected function __construct(array $config) {


        $this->consumer_secret       = $config['consumer_secret'];
        $this->consumer_key          = $config['consumer_key'];
        $this->shortcode             = $config['shortcode'];
        $this->pass_key              = $config['pass_key'];
        $this->callback_url          = $config['callback_url'];
        $this->initiator_name        = $config['initiator_name'];
        $this->initiator_pass        = $config['initiator_pass'];
        $this->confirmation_url      = $config['confirmation_url'];
        $this->timeout_url           = $config['timeout_url'];
        $this->validation_url        = $config['validation_url'];
        $this->result_url            = $config['result_url'];
        $this->live_endpoint      = 'https://api.safaricom.co.ke/';
        $this->sandbox_endpoint   = 'https://sandbox.safaricom.co.ke/';

        $this->env                   = $config['env '];

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
