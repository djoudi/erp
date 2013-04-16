<?php

class wh_user_reportsActions extends sfActions
{
    public function executeBydate (sfWebRequest $request)
    {
        $this->user = $this->getUser()->getGuardUser();
        $user_id = $this->user->getId();
        
        //@TEST:
        #user_id = 39
        
        // Calculating day objects
            
            $dateStart = new DateTime (date("Y-m-d"));
            $dateStart->sub (new DateInterval("P".(date('N')-1)."D")); //haftabasi
            $dateStart->sub (new DateInterval("P7D")); //iki onceki haftabasi
            $dateEnd = new DateTime (date("Y-m-d"));
            
            //@TEST:           
            #$dateEnd->add (new DateInterval("P14D")); //onceki haftabasi
            
        // Fetching Up to day balance
            
            /* @TODO */
            // bir tarihe göre mevcut bakiyeyi hesaplayan formul olacak
            
            $upToDayBalance = 0;
            
            $this->upToDayBalanceHuman = Fmc_Core_Time::getTimeEasy ($upToDayBalance);
        
        // Initializing array and counter
            
            $results = array();
            $i = 0;
        
        while ($dateStart <= $dateEnd)
        {
            // Setting date and getting objects 
                
                $date = $dateStart->format('Y-m-d');
                
                $day = Doctrine::getTable("WorkingHourDay")->getActiveDate ($date, $user_id);
                
            // Field: date
                
                $results[$i]["date"] = $date;
            
            // Field: dayOfTheWeek
            
                $results[$i]["dayOfTheWeek"] = $dateStart->format("l");
            
            // Field: dayClass
                
                if (whDayInfo::isHoliday($date)) $dayClass = "holiday";
                elseif (whDayInfo::isWeekend($date)) $dayClass = "weekend";
                else $dayClass = "";
                
                $results[$i]["dayClass"] = $dayClass;
            
            // Field: dayHours
                
                $param = Doctrine::getTable('WorkingHourParameter')->findOneByParam('DailyWorkHours');
                
                $results[$i]["dayHours"] = whDayInfo::isVacation($date) ? 0 : $param["value"]*60;
                
                $results[$i]["dayHoursHuman"] = Fmc_Core_Time::getTimeEasy ($results[$i]["dayHours"]);
            
            // Field: dayMultiplier
            
                $results[$i]["dayMultiplier"] = is_object ($day) ? $day->getMultiplier() : "";
            
            // Field: dayType
                
                $results[$i]["dayType"] = Doctrine::getTable("WorkingHourDay")->getDateType ($date, $user_id);
            
            // Field: dayStatus
            
                $results[$i]["dayStatus"] = is_object($day) ? $day->getStatus() : "-";#Doctrine::getTable("WorkingHourDay")->getDateType ($date, $user_id);
                
            // Field: workedHours
                
                $results[$i]["workedHours"] = is_object ($day) ? $day->calculateDayHours(false) : 0;
                
                $results[$i]["workedHoursHuman"] = Fmc_Core_Time::getTimeEasy ($results[$i]["workedHours"]);
            
            // Field: dayBreaks
            
                $results[$i]["dayBreaks"] = is_object ($day) ? ($day->getDailyBreaks())*60 : 0;
                
                $results[$i]["dayBreaksHuman"] = $results[$i]["dayBreaks"] ? Fmc_Core_Time::getTimeEasy($results[$i]["dayBreaks"]) : "";
                
            // Field: workedHoursMultiplied
            
                $results[$i]["workedHoursMultiplied"] = $results[$i]["workedHours"] * $results[$i]["dayMultiplier"];
                
                $results[$i]["workedHoursMultipliedHuman"] = Fmc_Core_Time::getTimeEasy ($results[$i]["workedHoursMultiplied"]);
            
            // Field: dayBalance
                
                $results[$i]["dayBalance"] = $results[$i]["workedHoursMultiplied"] - $results[$i]["dayHours"];
                
                $param = Doctrine::getTable('WorkingHourParameter')->findOneByParam('DefaultDailyBreaks');
                
                $dailyBreakDif = $results[$i]["dayBreaks"] - $param["value"]*60;
                
                if ($results[$i]["dayBreaks"]) $results[$i]["dayBalance"] -= $dailyBreakDif;
                
                $results[$i]["dayBalanceHuman"] = Fmc_Core_Time::getTimeEasy ($results[$i]["dayBalance"]);
            
            // Field: totalBalance
                
                if ($i==0)
                {
                    $results[$i]["totalBalance"] =  $results[$i]["dayBalance"] + $upToDayBalance;
                }
                else
                {
                    $results[$i]["totalBalance"] =  $results[$i]["dayBalance"] + $results[$i-1]["totalBalance"];
                }
                
                $results[$i]["totalBalanceHuman"] = Fmc_Core_Time::getTimeEasy ($results[$i]["totalBalance"]);
                
            // Counter increasing
                
                $dateStart->add (new DateInterval('P1D'));
                $i++;
        }
        
        $this->results = $results;
    }
}
