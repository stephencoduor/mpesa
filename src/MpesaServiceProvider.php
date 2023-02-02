<?php

/*
 * This file is part of the Laravel Mpesa package.
 *
 * (c) Stephen Oduor <stephencoduor@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Stephencoduor\Mpesa;

use Illuminate\Support\ServiceProvider;

class MpesaServiceProvider extends ServiceProvider
{

    /*
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
    protected $defer = false;

    /**
     * Publishes all the config file this package needs to function
     */
    public function boot()
    {
        $config = realpath(__DIR__ . '/../resources/config/mpesa.php');

        $this->publishes([
            $config => config_path('mpesa.php')
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('laravel-paystack', function () {

            return new Mpesa;

        });
    }

    /**
     * Get the services provided by the provider
     * @return array
     */
    public function provides()
    {
        return ['laravel-paystack'];
    }
}
