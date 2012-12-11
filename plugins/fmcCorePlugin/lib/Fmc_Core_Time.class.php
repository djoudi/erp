<?php

class Fmc_Core_Time
{
    public static function TimeToStamp ($time)
    {
        $oldtz = date_default_timezone_get();
        date_default_timezone_set('UTC');
        
        $arr = explode(':', $time);
        if (count($arr)<3) $arr[2]="00";
        #if (count($arr)<2) $arr[1]="00";
        $epoch = mktime($arr[0], $arr[1], $arr[2], "01", "01", "1970");
        
        date_default_timezone_set($oldtz);
        
        return $epoch ? $epoch : 0;
    }
    
    public static function getTimeDifEasy ($end, $start)
    {
        $startTS = Fmc_Core_Time::TimeToStamp ($start);
        
        $endTS = Fmc_Core_Time::TimeToStamp ($end);
        
        $dif = $endTS - $startTS;
        
        $h = ( $dif - ($dif % 3600) ) / 3600;
        
        $dif -= $h*3600;
        
        $m = ( $dif - ($dif % 60) ) / 60;
        
        return $h."h ".$m."m";
    }
        
}
