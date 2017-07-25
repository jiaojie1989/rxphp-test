<?php

/*
 * Copyright (C) 2017 SINA Corporation
 *  
 *  
 * 
 * This script is firstly created at 2017-07-25.
 * 
 * To see more infomation,
 *    visit our official website http://jiaoyi.sina.com.cn/.
 */

require __DIR__ . "/../vendor/autoload.php";

$loop = new React\EventLoop\StreamSelectLoop;
$scheduler = new Rx\Scheduler\EventLoopScheduler($loop);

$disposable = Rx\Observable::range(1, 10)
        ->subscribeCallback(function($val) use (&$disposable) {
    var_dump($val);
    if ($val == 5) {
        $disposable->dispose();
    }
}, null, null, $scheduler);

$scheduler->start();
