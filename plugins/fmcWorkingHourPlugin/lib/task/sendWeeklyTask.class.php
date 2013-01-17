<?php

class sendWeeklyTask extends sfBaseTask
{
    
    protected function configure()
    {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));
        
        $this->namespace        = 'workingHour';
        $this->name             = 'sendWeekly';
        $this->briefDescription = '';
        $this->detailedDescription = '';
    }
    
    
    protected function execute($arguments = array(), $options = array())
    {
        // Loading configuration
        
        $databaseManager = new sfDatabaseManager($this->configuration);
        
        $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
        
        $context = sfContext::createInstance($this->configuration);
        
        $this->configuration->loadHelpers('Partial');
        
        // Starting task
        
        $employees = Doctrine::getTable('sfGuardUser')->getActive();
        
        foreach ($employees as $employee)
        {
            if ($employee['send_Email'])
            {
                // Preparing data
                
                $draftLeaves = Doctrine::getTable('LeaveRequest')
                    ->getListForEmployee($employee['id'],"Draft");
                    
                $pendingLeaves = Doctrine::getTable('LeaveRequest')
                    ->getListForEmployee($employee['id'],"Pending");
                
                $daysEmpty = array();
                $daysIncomplete = array();
                
                $startDate = new DateTime ("2013-01-01");
                $endDate = new DateTime (date("Y-m-d"));
                $endDate->sub (new DateInterval('P6D'));
                
                while ($startDate != $endDate)
                {
                    $date = $startDate->format('Y-m-d');
                    
                    if (!whDayInfo::isHoliday($date))
                    {
                        $day = Doctrine::getTable('WorkingHourDay')->getActiveDate ($date, $employee['id']);
                        
                        if (!$day)
                            array_push ($daysEmpty, $date);
                        else
                        {
                            if ( (!$day['leave_id']) && ($day['status']=="Draft") )
                            {
                                array_push ($daysIncomplete, $date);
                            }
                        }
                    }
                    
                    $startDate->add (new DateInterval('P1D'));
                }
                
                // Sending Email
                
                // Thanks to: http://pookey.co.uk/wordpress/archives/91-sending-multipart-email-from-a-task-in-symfony-1-4
                
                if (count($draftLeaves)+count($pendingLeaves)+count($daysEmpty)+count($daysIncomplete))
                {
                    $subject = "Weekly WHDB report for {$date}";
                    
                    $message = $this->getMailer()->compose(
                        array('datamanagement@fmconsulting.info'=>'FMC Data Management'), 
                        $employee['email_address'], 
                        $subject
                    );
                    
                    // generate HTML part
                        
                        $context->getRequest()->setRequestFormat('html');
                        
                        $html = get_partial('workingHourCore/sendWeeklyHtml',array(
                            'subject' => $subject, 
                            'employee' => $employee, 
                            'daysEmpty' => $daysEmpty, 
                            'daysIncomplete' => $daysIncomplete, 
                            'draftLeaves' => $draftLeaves, 
                            'pendingLeaves' => $pendingLeaves, 
                        ));
                        
                        $message->setBody($html, 'text/html');
                        
                    // generate plain text part
                        
                        $context->getRequest()->setRequestFormat('txt');
                        
                        $plain = get_partial('workingHourCore/sendWeeklyPlain',array(
                            'subject' => $subject, 
                            'employee' => $employee, 
                            'daysEmpty' => $daysEmpty, 
                            'daysIncomplete' => $daysIncomplete, 
                            'draftLeaves' => $draftLeaves, 
                            'pendingLeaves' => $pendingLeaves, 
                        ));
                        
                        $message->addPart($plain, 'text/plain');
                    
                    // send the message
                    
                        $this->getMailer()->send($message);
                    
                }
            }
        }
 
    }
}
