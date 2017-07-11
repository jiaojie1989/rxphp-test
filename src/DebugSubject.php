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

/**
 * Description of DebugSubject
 *
 * @encoding UTF-8 
 * @author jiaojie <jiaojie@staff.sina.com.cn> 
 * @since 2017-07-11 10:31 (CST) 
 * @version 0.1
 * @description 
 */
class DebugSubject extends \Rx\Subject\Subject
{

    public function __construct($identifier = null, $maxLen = 64)
    {
        $this->identifier = $identifier;
        $this->maxLen = $maxLen;
    }

    public function onCompleted()
    {
        printf("%s%s onCompleted\n", $this->getTime(), $this->id());
        parent::onCompleted();
    }

    public function onNext($val)
    {
        $type = is_object($val) ? get_class($val) : gettype($val);
        if (is_object($val) && method_exists($val, '__toString')) {
            $str = (string) $val;
        } elseif (is_object($val)) {
            $str = get_class($val);
        } elseif (is_array($val)) {
            $str = json_encode($val);
        } else {
            $str = $val;
        }

        if (is_string($str) && strlen($str) > $this->maxLen) {
            $str = substr($str, 0, $this->maxLen) . '...';
        }
        printf("%s%s onNext: %s (%s)\n", $this->getTime(), $this->id(), $str, $type);
        parent::onNext($val);
    }

    private function getTime()
    {
        return date("H:i:s");
    }

    private function id()
    {
        return "[{$this->identifier}]";
    }

}
