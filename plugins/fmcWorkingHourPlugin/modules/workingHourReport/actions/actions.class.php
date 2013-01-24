<?php

class workingHourReportActions extends sfActions
{
    
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
