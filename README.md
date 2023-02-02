# Introduction
Mpesa library which you can use with various framework like laravel ,codeigniter ,cakephp and many more
This package seeks to help php developers implement the various Mpesa APIs without much hustle. It is based on the REST API whose documentation is available on https://developer.safaricom.co.ke.

#  Installation using composer
``` bash
  composer require stephencoduor/mpesa
```
Or add the following line to the require block of your `composer.json` file.

```
"stephencoduor/mpesa": "^1.0.*"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.



Once Laravel Mpesa is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

```php
'providers' => [
    ...
    Stephencoduor\Mpesa\MpesaServiceProvider::class,
    ...
]
```

> If you use **Laravel >= 5.5** you can skip this step and go to [**`configuration`**](#)

* `Stephencoduor\Mpesa\MpesaServiceProvider::class`

Also, register the Facade like so:

```php
'aliases' => [
    ...
    'Mpesa' => Stephencoduor\Mpesa\Facades\Mpesa::class,
    ...
]
```



## Configuration

You can publish the configuration file using this command:

```bash
php artisan vendor:publish --provider="Stephencoduor\Mpesa\MpesaServiceProvider"
```

A configuration-file named `mpesa.php` with some sensible defaults will be placed in your `config` directory:

```php


#  Usage example

  ```require_once('vendor/autoload.php')```
  use the above statement if it procedural app else if its codeigniter 3.x go config enable $config['composer_autoload'] = 'vendor/autoload.php'; 
  if vendor is root folder if vendor file are on application it should be $config['composer_autoload'] = true ,
  for laravel and other framework they have no problem
     
     

    use Stephencoduor\Mpesa\Mpesa;

A

    $mpesa = new Mpesa();


---------------Now you can call functions on Mpesa as Below ----------------

    echo " Token : " . $mpesa->oauth_token();
    $mpesa = new Mpesa();
    $mpesa->express()->stkPushQuery('ws_CO_DMZ_297481201_09042019174418021');
    $mpesa->express()->stkPush('1','254708374149','pay now','test',''https://example.com/callback_url/);

    
    $mpesa->c2b()->register_url('https://example.com/$confirmation_url/','https://example.com/validation_url/'); 
    $mpesa->c2b()->c2bPay('1000', '254708374149', 'account');

    
    $mpesa->b2c()->b2cSend('200', 'BusinessPayment', '254708374149', 'payment','b2c_timeout','b2c_result'); // last two parameter define callback https://example.com/result_url.php/b2c_timeout/ or https://example.com/result_url/b2c_result/
    
    
    $mpesa->b2c()->b2bSend('10000','BusinessPayBill','60000','4','4','paytest','cool','b2b_timeout','b2b_result');

    $mpesa = new Mpesa()
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
