<?php

/*
 * Copyright (C) 2017 SINA Corporation
 *  
 *  
 * 
 * This script is firstly created at 2017-07-05.
 * 
 * To see more infomation,
 *    visit our official website http://app.finance.sina.com.cn/.
 */

$time = microtime(true);
error_reporting(E_ALL);
ini_set("display_errors", true);

require __DIR__ . '/../vendor/autoload.php';

$fruits = ['apple', 'banana', 'orange', 'raspberry'];
$vegetables = ['potato', 'carrot'];

$iterator = function() use($fruits) {
    foreach ($fruits as $fruit) {
        yield $fruit;
    }
};

var_dump($iterator());

(new \Rx\Observable\IteratorObservable($iterator()))
        ->map(function($value) {
            return strlen($value);
        })->filter(function($len) {
    return $len > 5;
})->subscribe(new \Rx\Observer\CallbackObserver(function($value) {
    var_dump($value);
}, null, null));

var_dump(microtime(true) - $time);
var_dump(bcdiv(memory_get_peak_usage(true), 1024 * 1024, 4));
