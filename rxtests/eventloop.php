<?php

/*
 * Copyright (C) 2017 SINA Corporation
 *  
 *  
 * 
 * This script is firstly created at 2017-07-20.
 * 
 * To see more infomation,
 *    visit our official website http://jiaoyi.sina.com.cn/.
 */
error_reporting(E_ALL);
ini_set("display_errors", true);

require __DIR__ . "/../vendor/autoload.php";

$loop = new React\EventLoop\StreamSelectLoop();
$scheduler = new Rx\Scheduler\EventLoopScheduler($loop);

$observable = Rx\Observable::interval(1000, $scheduler)
        ->take(10)
        ->subscribe(new \Jiaojie\DebugSubject());

$loop->run();
