<?php

namespace Stephencoduor\Mpesa;

class Config
{

    //public string $SecurityCredential;
    protected string  $consumer_key;
    protected string  $consumer_secret;
    protected string  $shortcode;
    protected string $pass_key;
    protected string $initiator_name;
    protected string $initiator_pass;
    protected string $security_credential;
    protected string $confirmation_url;
    protected string $timeout_url;
    protected string $validation_url;
    protected string $callback_url;
    protected string $result_url;
    protected string $live_endpoint;
    protected string $sandbox_endpoint;

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
