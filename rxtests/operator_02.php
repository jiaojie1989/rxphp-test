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

use Jiaojie\DebugSubject;
use Jiaojie\JSONDecodeOperator;
use Rx\Observable;

require __DIR__ . "/../vendor/autoload.php";

Observable::just('{"value"a: 42}')
        ->lift(function() {
            return new JSONDecodeOperator();
        })
        ->subscribe(new DebugSubject());
