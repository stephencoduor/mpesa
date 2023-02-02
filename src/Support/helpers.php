<?php

if (! function_exists("mpesa"))
{
    function mpesa() {

        return app()->make('mpesa');
    }
}