<?php

class workingHourReportActions extends sfActions
{
    public function PrepareQuery ($date)
    {
        $q = Doctrine::getTable ('sfGuardUser')
            ->createQuery ('u')
            ->innerJoin ('u.WorkingHourDay d')
            ->leftJoin ('d.WorkingHourRecords r')
            ->leftJoin ('d.LeaveRequest l')
            ->leftJoin ('l.LeaveType t')
            ->addWhere ('d.date = ?', $date)
            ->addWhere ('d.status <> ?', "Denied")
            ->orderBy ('u.first_name, r.start_Time, r.recordType ASC');
        return $q->execute();
    }
    
    
    public function executeDailyExcel (sfWebRequest $request)
    {
        $list = $this->PrepareQuery ($date = $request->getParameter('date'));
        
        $this->forward404Unless ($list);
        
        // @TODO : move this to a (excel class perhaps)?
        
        // Creating Excel File
        
        $xfile = sfConfig::get('sf_upload_dir')."/excelTemplates/workingHourReportDaily.xls";
        
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        
        $objPHPExcel = $objReader->load($xfile);
        
        // Writing Values
        
        $objPHPExcel
            ->setActiveSheetIndex(0)
            ->setCellValue ('A44', 'Printed by '.$this->getUser()->getGuardUser().' on '.date("Y-m-d H:i:s"))
            ->setcellValue ('A45', $_SERVER['HTTP_REFERER'])
            ->setcellValue ('B4', $date);
        
        $row = 7;
        
        foreach ($list as $item)
        {
            $type = $item['WorkingHourDay'][0]['leave_id'] ? "Leave" : "Work";
            
            if ($type == "Work")
                $details = whDayInfo::getDayIORegular ($item['WorkingHourDay'][0]['WorkingHourRecords']);
            else
                $details = $item['WorkingHourDay'][0]['LeaveRequest']['LeaveType']['name'];
            
            $objPHPExcel
                ->setActiveSheetIndex(0)
                ->setcellValue ("A".$row, $item['first_name']." ".$item['last_name'])
                ->setcellValue ("C".$row, $item['WorkingHourDay'][0]['status'])
                ->setcellValue ("D".$row, $type)
                ->setcellValue ("E".$row, $details);
            
            $row++;
        }
        
        // Finalizing File
        
        $objPHPExcel->getActiveSheet()->setTitle('WHDB-ReportDaily');
        
        header('Content-Type: application/vnd.ms-excel');
        
        header('Content-Disposition: attachment;filename="fmcdata-DailyReport-'.$date.'.xls"');
        
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        
        $objWriter->save('php://output');
        
        // Redirecting Back
        
        $this->redirect($request->getReferer());
    }
    
    
    public function executeDaily (sfWebRequest $request)
    {
        if ( ! ( $this->date = $request->getParameter('date') ) )
            $this->date = date("Y-m-d");
        
        $this->list = $this->PrepareQuery ($this->date);
        
        $this->forward404Unless ($this->list);
    }
    
}
