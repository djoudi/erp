    
 
    
        
        <?php
        if ($status=="empty")
        {
            include_component ('WHUser_Day', 'newDay', array(
                'date'=>$date, 
                'form'=>$form, 
            ));
            
        }
        elseif ($status=="workday" && $day['status']!="Draft")
        {
            include_partial ('itemlist', array(
                'day'=>$day
            ));
        }
        elseif ($status=="workday")
        {
            include_partial ('day_workday', array(
                'day' => $day, 
                'workForm' => $workForm, 
                'entranceForm' => $entranceForm,
                'exitForm' => $exitForm,
                'dayForm' => $dayForm
            ));
        }
        ?>
        
    
    
