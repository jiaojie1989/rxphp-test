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

namespace Jiaojie;

use Rx\ObservableInterface;
use Rx\ObserverInterface;
use Rx\SchedulerInterface;
use Rx\Operator\OperatorInterface;
use Rx\DisposableInterface;

/**
 * Description of JSONDecodeOperator
 *
 * @encoding UTF-8 
 * @author jiaojie <jiaojie@staff.sina.com.cn> 
 * @since 2017-07-11 11:35 (CST) 
 * @version 0.1
 * @description 
 */
class JSONDecodeOperator implements OperatorInterface
{

    public function __invoke(ObservableInterface $observable, ObserverInterface $observer, SchedulerInterface $scheduler = null): DisposableInterface
    {
        $obs = new \Rx\Observer\CallbackObserver(function($value) use ($observer) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $observer->onNext($decoded);
            } else {
                $msg = json_last_error_msg();
                $e = new \InvalidArgumentException($msg);
                $observer->onError($e);
            }
        }, function($error) use($observer) {
            $observer->onError($error);
        }, function() use($observer) {
            $observer->onCompleted();
        });
        return $observable->subscribe($obs, $scheduler);
    }

}
