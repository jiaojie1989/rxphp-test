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

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.baidu.com/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, "progress");
curl_setopt($ch, CURLOPT_NOPROGRESS, false);
curl_setopt($ch, CURLOPT_HEADER, 0);
$html = curl_exec($ch);
curl_close($ch);

function progress($res, $downtotal, $down, $uptotal, $up)
{
    if ($downtotal > 0) {
        printf("%.2f   %s\n", $down / $downtotal * 100, microtime(true));
    }
//    ob_flush();
//    usleep(100 * 1000);
}
