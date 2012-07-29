<?php

abstract class Basewh_ReportsActions extends sfActions {
    
    public function executeOeexcel (sfWebRequest $request) {
        
        $date = $request->getParameter('date');
        $leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        if ($date) {
            $users = Doctrine::getTable('sfGuardUser')->all_wh_reports_oe();
        }
        
        $xfile = sfConfig::get('sf_web_dir')."/fmcWorkingHourPlugin/reportTemplates/officeentrance.xls";
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load($xfile);
        
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E3', $date )
            ->setCellValue('E4', sfContext::getInstance()->getUser()->getGuardUser()->getName())
            ->setCellValue('E5', date('l jS \of F Y h:i:s A') )
        ;
        
        $row = 8;
        
        foreach ($users as $user) {
            
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue ("A$row", ($row-7) )
                ->setCellValue ("B$row", $user["first_name"]." ".$user["last_name"] )
            ;
            
            $status = $user->getDayStatusFor($date);
            
            if ($status=="leave") {
                
                $leave = $user->getLeave($date);
                
                $text = $leaveStatus[$leave["type"]];
                if ($leave["description"]) $text .= " - ".$leave["description"];
                
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue ("C$row", $text );
                
            } elseif ($status=="work") {
                
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue ("C$row", $user->getEntranceFor($date) )
                    ->setCellValue ("D$row", $user->getExitFor($date) )
                    ->setCellValue ("E$row", $user->getOfficeDif($date) )
                    ->setCellValue ("F$row", $user->getActiveHours($date) );
                
            } else {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue ("C$row", "-" );
            }
            
            $row++;
        }

          #->setCellValue('XXXX', $form->Projects->code)
          #->setCellValue('XXXXX', $form->id)
          #->setCellValue('XXXX', $form->advanceRecieved);
        #$objPHPExcel->getActiveSheet()->setTitle('Report');
        
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="officereport-'.$date.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

        $this->redirect($request->getReferer());
        
        
        
    }
    
    public function executeOfficeentrance (sfWebRequest $request) {
        /*
         * echo "<pre>";
        print_r(sfConfig::getAll());
        echo "</pre>";
        */
        $this->date = $request->getParameter('date');
        $this->leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        if ($this->date) {
            $this->users = Doctrine::getTable('sfGuardUser')->all_wh_reports_oe();
        }
        
    }
    
}
