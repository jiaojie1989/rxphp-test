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

use Jiaojie\CURLObservable;
use Jiaojie\DebugSubject;

require __DIR__ . "/../vendor/autoload.php";

//$url = "http://cj.sina.com.cn/api/article/article_top3";
$url = "https://www.zhihu.com/";

$observable = new CURLObservable($url);

$observable2 = $observable->distinctUntilChanged()
        ->lift(function() {
    return new \Jiaojie\JSONDecodeOperator();
});

$observable2->subscribe(new DebugSubject('curl', 1024));
