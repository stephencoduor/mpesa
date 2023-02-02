<?php

/*
 * This file is part of the Laravel Mpesa package.
 *
 * (c) Stephen Oduor <stephencoduor@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [


    /**
     * Mpesa Consumer Key
     *
     */
    'publicKey' => getenv('MPESA_CONSUMER_KEY'),

    /**
     *  Mpesa Secret Key
     *
     */
    'secretKey' => getenv('MPESA_SECRET_KEY'),

    /**
     * Mpesa Shortcode
     *
     */
    'shortcode' => getenv('MPESA_SHORTCODE'),
    /**
     * Mpesa Pass Key
     *
     */
    'passKey' => getenv('MPESA_PASSKEY'),
    /**
     * Mpesa store Number
     *
     */
    'store' => getenv('MPESA_STORE'),
    /**
     * Mpesa Initiator Name
     *
     */
    'initiatorName' => getenv('INITIATOR_NAME'),

    /**
     * Mpesa Initiator Password
     *
     */
    'initiatorPassword' => getenv('INITIATOR_PASSWORD'),

    /**
     * Mpesa Transaction Type
     *
     */
    'transactionType' => getenv('TRANSACTION_TYPE'),


    /**
     * Mpesa Initiator Environment
     *
     */
    'environment' => getenv('ENVIRONMENT'),

];
