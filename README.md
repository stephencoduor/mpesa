# Introduction
Mpesa library which you can use with various framework like laravel ,codeigniter ,cakephp and many more
This package seeks to help php developers implement the various Mpesa APIs without much hustle. It is based on the REST API whose documentation is available on https://developer.safaricom.co.ke.

#  Installation using composer
``` bash
$ composer require stephencoduor/mpesa
```

#  Usage example

     require_once('vendor/autoload.php')
  use the above statement if it procedural app else if its codeigniter 3.x go config enable $config['composer_autoload'] = 'vendor/autoload.php'; 
  if vendor is root folder if vendor file are on application it should be $config['composer_autoload'] = true ,
  for laravel and other framework they have no problem
     
     

    use Stephencoduor\Mpesa\Mpesa;


    $mpesa = new Mpesa( 
    
    [

    "consumer_key"               => "Your Consumer Key",
    "consumer_secret"            => "Your Consumer Secret",
    "shortcode"                  => "174379",
    "shortcode1"                 => "174379",
    "passkey"                    => "Your Online Passkey",
    'initiator_name'             => 'Your initiator_name',
    'initiator_pass'             => 'Your initiator_pass',
    "callback_url"               => "https://example.com/callback_url/",
    "confirmation_url"           => "https://example.com/confirmation_url/",
    "timeout_url"                => "https://example.com/timeout_url/",
    "validation_url"             => "https://example.com/validation_url/",
    "results_url"                => "https://example.com/timeout_url/",
    "env"                        => "sandbox",
    ]
    );




---------------Or Pass an Array of the configuration as below -----------------
    
    $config = [

            "consumer_key"               => "Your Consumer Key",
            "consumer_secret"            => "Your Consumer Secret",
            "shortcode"                  => "174379",
            "shortcode1"                 => "174379",
            "passkey"                    => "Your Online Passkey",
            'initiator_name'             => 'Your initiator_name',
            'initiator_pass'             => 'Your initiator_pass',
            "callback_url"               => "https://example.com/callback_url/",
            "confirmation_url"           => "https://example.com/confirmation_url/",
            "timeout_url"                => "https://example.com/timeout_url/",
            "validation_url"             => "https://example.com/validation_url/",
            "results_url"                => "https://example.com/timeout_url/",
            "env"                        => "sandbox",
           ]


    $mpesa  = new Mpesa(array $config);




---------------Now you can call functions on Mpesa as Below ----------------

    echo " Token : " . $mpesa->oauth_token();
    $mpesa->stkPushQuery('ws_CO_DMZ_297481201_09042019174418021');
    $mpesa->stk('1','254708374149','pay now','test');
    $mpesa->register_url(); 
    $mpesa->c2b('1000', '254708374149', 'account');
    $mpesa->b2c('200', 'BusinessPayment', '254708374149', 'payment','b2c_timeout','b2c_result'); // last two parameter define callback https://example.com/result_url.php/b2c_timeout/ or https://example.com/result_url/b2c_result/
    $mpesa->b2b('10000','BusinessPayBill','60000','4','4','paytest','cool','b2b_timeout','b2b_result');
    $mpesa->accountbalance('600443','4','remarks','acc_timeout','acc_result');
    $mpesa->reversal('2','254708374149','1','NCR7S1UXBT','PAY NOW');
    $mpesa->transaction_status('NCR7S1UXBT','254708374149','4','apitest');
    
 # get responses
    echo $mpesa->getResponseData();
    
# Callback json data received from safaricom
    for call back you can use you own implementation 
    this is for testing.
    
    use Stephencoduor\Mpesa\Callback;

    $callback = new Callback;
    $callback::processSTKPushRequestCallback();
    $callback::processC2BRequestConfirmation();
    $callback::processC2BRequestValidation();
    $callback::processB2CRequestCallback();
    $callback::processB2BRequestCallback();
    $callback::processAccountBalanceRequestCallback();
    $callback::processReversalRequestCallBack();
    $callback::processTransactionStatusRequestCallback();

    
  ## Contributing



## Security


## Credits


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
