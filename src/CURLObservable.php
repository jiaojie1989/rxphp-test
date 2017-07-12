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

use Rx\Observable;
use Rx\ObservableInterface;
use Rx\ObserverInterface;
use Rx\DisposableInterface;
use Rx\SchedulerInterface;

/**
 * Description of CURLObservable
 *
 * @encoding UTF-8 
 * @author jiaojie <jiaojie@staff.sina.com.cn> 
 * @since 2017-07-11 16:38 (CST) 
 * @version 0.1
 * @description 
 */
class CURLObservable extends Observable
{

    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function subscribe(ObserverInterface $observer, $scheduler = null)
    {
        $disp1 = parent::subscribe();
    }

    private function startDownload()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, [$this, "progress"]);
        curl_setopt($ch, CURLOPT_NOPROGRESS, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
        curl_setopt($ch, CURLOPT_ENCODING, "gzip;q=0,deflate,sdch");
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    private function progress($res, $downtotal, $down, $uptotal, $up)
    {
        if ($downtotal > 0) {
            $percentage = sprintf("%.2f", $down / $downtotal * 100);
            foreach ($this->observers as $observer) {
                $observer->onNext(floatval($percentage));
            }
        }
    }

}
