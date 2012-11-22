<?php

class Fmc_Core_Time
{
    public static function TimeToStamp ($time)
    {
        $oldtz = date_default_timezone_get();
        date_default_timezone_set('UTC');
        $arr = explode(':', $time);
        $epoch = mktime($arr[0], $arr[1], $arr[2], "01", "01", "1970");
        date_default_timezone_set($oldtz);
        return $epoch;
    }
    
}
