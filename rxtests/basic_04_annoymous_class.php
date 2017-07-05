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

(new \Rx\Observable\IteratorObservable($iterator()))
        ->map(function($value) {
            return strlen($value);
        })->filter(function($len) {
    return $len > 5;
})->subscribe(new class extends \Rx\Observer\AbstractObserver {

    protected function completed()
    {
        echo ("Completed\n");
    }

    protected function next($item)
    {
        echo sprintf("Next: %s\n", $item);
    }

    protected function error(Exception $err)
    {
        $msg = $err->getMessage();
        echo sprintf("Error: %s\n", $msg);
    }
});
