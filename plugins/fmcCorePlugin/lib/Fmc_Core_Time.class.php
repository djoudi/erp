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
    
    public static function getTimeEasy ($time)
    {
        $min = $time % 3600;
        
        $hour = ($time-$min) / 3600;
        
        return "{$hour}h {$min}m";
    }
    
    public static function getTimeDif ($end, $start)
    {
        $startTS = Fmc_Core_Time::TimeToStamp ($start);
        
        $endTS = Fmc_Core_Time::TimeToStamp ($end);
        
        return $endTS - $startTS;
    }
    
    public static function getTimeDifEasy ($end, $start)
    {
        $dif = Fmc_Core_Time::getTimeDif ($end, $start);
        
        return Fmc_Core_Time::getTimeEasy ($endTS - $startTS);
    }
        
}
