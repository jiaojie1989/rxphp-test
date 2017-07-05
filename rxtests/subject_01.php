<?php

/*
 * Copyright (C) 2017 SINA Corporation
 *  
 *  
 * 
 * This script is firstly created at 2017-07-05.
 * 
 * To see more infomation,
 *    visit our official website http://jiaoyi.sina.com.cn/.
 */

require __DIR__ . "/../vendor/autoload.php";

$subject = new \Rx\Subject\Subject();
$subject->map(function($value) {
            return strlen($value);
        })
        ->filter(function($len) {
            return $len > 5;
        })
        ->subscribeCallback(function($value) {
            var_dump($value);
        }, null, function() {
            echo "Completed ! \n";
        });

$subject->onNext("banana");
$subject->onCompleted();
