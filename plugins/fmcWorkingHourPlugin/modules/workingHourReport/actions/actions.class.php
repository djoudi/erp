<?php

class workingHourReportActions extends sfActions
{
    public function executeEmployeeExcel (sfWebRequest $request)
    {
        $from = $request->getParameter('from');
        $to = $request->getParameter('to');
        $emp = $request->getParameter('emp');
        
        $items = whQuery::prepareReportEmployee($from, $to, $emp);
        
        $this->forward404Unless ($items);
        
        $empRecord = Doctrine::getTable('sfGuardUser')->findOneById ($emp);
        $employee = $empRecord->__toString();
        
        // Excel parameters
        
        $template = sfConfig::get('sf_upload_dir')."/excelTemplates/wh_report_employee.xls";
        $title = 'WHDB-Report-Employee';
        $filename = "WH-{$employee}_{$from}_to_{$to}.xls";
        
        // Preparing values
        
        $values = array();
        $values["A1"] = $employee;
        
        $row = 5;
        $totalMin = 0;
        
        foreach ($items as $item)
        {
            $timeDif = Fmc_Core_Time::getTimeDif ($item['end_Time'], $item['start_Time']);
            $totalMin += $timeDif;
            
            $values["A{$row}"] = $item['Day']['date'];
            $values["B{$row}"] = $item['Project']['code'];
            $values["C{$row}"] = Fmc_Core_Time::getTimeEasy ($timeDif);
            $values["D{$row}"] = $item['WorkType']['name'];
            $values["E{$row}"] = $item['comment'];
            $row++;
        }
        
        $row++;
        $values["B{$row}"] = "Total";
        $values["C{$row}"] = Fmc_Core_Time::getTimeEasy ($totalMin);
        
        // Preparing output
        
        FmcExcel::prepare ($template, $title, $filename, $values, "A2");
        
        $this->redirect($request->getReferer());
        
    }
    
    
    public function executeEmployee (sfWebRequest $request)
    {
        $this->form = new form_wh_report_employee();
        
        $this->items = NULL;
        
        if ($request->isMethod('post'))
        {
            $this->form->bind ($request->getParameter($this->form->getName()));
            
            if ($this->form->isValid())
            {
                $values = $this->form->getValues();
                
                $this->from = $values['date']['from'];
                $this->to = $values['date']['to'];
                $this->emp = $values['employee_id'];
                
                $this->items = whQuery::prepareReportEmployee($this->from,$this->to,$this->emp);
            }
            else
            {
                $this->getUser()->setFlash ('error', 'Problem with your filter!');
            }
        }
    }
    
    
    
    public function executeDailyExcel (sfWebRequest $request)
    {
        $list = whQuery::prepareReportDaily ($date = $request->getParameter('date'));
        
        $this->forward404Unless ($list);
        
        // Excel parameters
        
        $template = sfConfig::get('sf_upload_dir')."/excelTemplates/workingHourReportDaily.xls";
        $title = 'WHDB-ReportDaily';
        $filename = "fmcdata-DailyReport-{$date}.xls";
        
        // Preparing values
        
        $values = array();
        $values["B4"] = $date;
        
        $row = 7;
        
        foreach ($list as $item)
        {
            $type = $item['WorkingHourDay'][0]['leave_id'] ? "Leave" : "Work";
            
            $day = Doctrine::getTable('WorkingHourDay')->findOneById($item['WorkingHourDay'][0]['id']);
            
            if ($type == "Work")
                $details = whDayInfo::getDayIORegular ($item['WorkingHourDay'][0]['WorkingHourRecords']);
            else
                $details = $item['WorkingHourDay'][0]['LeaveRequest']['LeaveType']['name'];
            
            $values["A{$row}"] =  $item['first_name']." ".$item['last_name'];
            $values["C{$row}"] =  $item['WorkingHourDay'][0]['status'];
            $values["D{$row}"] =  $type;
            $values["E{$row}"] =  $hours = $day->calculateDayHours();;
            $values["F{$row}"] =  $details;
            
            $row++;
        }
        
        // Preparing output
        
        FmcExcel::prepare ($template, $title, $filename, $values, "A44", "A45");
        
        $this->redirect($request->getReferer());
    }
    
    
    public function executeDaily (sfWebRequest $request)
    {
        if ( ! ( $this->date = $request->getParameter('date') ) )
        {
            $date = new DateTime();
            $date->sub(new DateInterval('P1D'));
            $this->date = $date->format('Y-m-d');
        }
        
        $this->list = whQuery::prepareReportDaily ($this->date);
        
        $this->forward404Unless ($this->list);
    }
    
}
