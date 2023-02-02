<?php

/*
 * This file is part of the Laravel Mpesa package.
 *
 * (c) Stephen Oduor <stephencoduor@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unicodeveloper\Paystack\Facades;

use Illuminate\Support\Facades\Facade;

class Mpesa extends Facade
{
    /**
     * Get the registered name of the component
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Mpesa';
    }
}