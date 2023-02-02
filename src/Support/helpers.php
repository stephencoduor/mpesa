<?php

if (! function_exists("mpesa"))
{
    function pmpesa() {

        return app()->make('mpesa');
    }
}