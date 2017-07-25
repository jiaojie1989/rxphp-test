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

use Rx\Observable;
use Rx\ObservableInterface;

require __DIR__ . "/../vendor/autoload.php";

class CustomRangeObservable extends Observable
{

    private $min;
    private $max;

    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function subscribe(\Rx\ObserverInterface $observer, $sched = null)
    {
        if (null === $sched) {
            $sched = new Rx\Scheduler\ImmediateScheduler();
        }

        return $sched->schedule(function () use ($observer) {
                    for ($i = $this->min; $i <= $this->max; $i++) {
                        $observer->onNext($i);
                    }
                    $observer->onCompleted();
                });
    }

}

//(new CustomRangeObservable(1, 10))
//        ->subscribe(new \Jiaojie\DebugSubject("debug"));


$loop = new React\EventLoop\StreamSelectLoop;
$scheduler = new Rx\Scheduler\EventLoopScheduler($loop);

$disposable = (new CustomRangeObservable(1, 10))
        ->subscribeCallback(function($val) use(&$disposable) {
    echo "{$val}\n";
    if ($val === 5) {
        $disposable->dispose();
    }
}, null, null, $scheduler);

$scheduler->start();
