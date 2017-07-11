<?php

/*
 * Copyright (C) 2017 SINA Corporation
 *  
 *  
 * 
 * This script is firstly created at 2017-07-11.
 * 
 * To see more infomation,
 *    visit our official website http://jiaoyi.sina.com.cn/.
 */

require __DIR__ . "/../vendor/autoload.php";

$fruits = ['apple', 'banana', 'orange', 'raspberry'];

$observable = \Rx\Observable::fromArray($fruits)
        ->map(function($value) {
            return strlen($value);
        })
        ->filter(function($len) {
    return $len > 5;
});
$observable->subscribe(new \Jiaojie\DebugSubject("A"));
$observable->subscribe(new \Jiaojie\DebugSubject("B"));
