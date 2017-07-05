<?php

/*
 * Copyright (C) 2017 SINA Corporation
 *  
 *  
 * 
 * This script is firstly created at 2017-07-04.
 * 
 * To see more infomation,
 *    visit our official website http://app.finance.sina.com.cn/.
 */

error_reporting(E_ALL);
ini_set("display_errors", true);

require __DIR__ . '/../vendor/autoload.php';

$fruits = ['apple', 'banana', 'orange', 'raspberry'];

\Rx\Observable::fromArray($fruits)
        ->map(function($value) {
            return strlen($value);
        })->filter(function($len) {
    return $len > 5;
})->subscribe(new \Rx\Observer\CallbackObserver(function($value) {
    var_dump($value);
}, null, null));

 