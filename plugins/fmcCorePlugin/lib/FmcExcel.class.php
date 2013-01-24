<?php
    
class FmcExcel
{
    public static function prepare (
        $template_url, 
        $title, 
        $filename, 
        $values, 
        $printer_cell = NULL, 
        $url_cell = NULL
    )
    {
        // Loading globals
        
        $date = date("Y-m-d H:i:s");
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        
        // Creating instance
        
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        
        $objPHPExcel = $objReader->load($template_url);
        
        // Setting values
        
        if (count($values))
        {
            foreach ($values as $index=>$value)
            {
                $objPHPExcel->setActiveSheetIndex(0)->setcellValue($index, $value);
            }
        }
        
        if ($printer_cell)
        {
            $objPHPExcel->setActiveSheetIndex(0)->setcellValue($printer_cell, "Printed by {$user} on {$date}.");
        }
        
        if ($url_cell)
        {
            $objPHPExcel->setActiveSheetIndex(0)->setcellValue($url_cell, $_SERVER['HTTP_REFERER']);
        }
        
        // Creating output
        
        $objPHPExcel->getActiveSheet()->setTitle($title);
        
        header('Content-Type: application/vnd.ms-excel');
        
        header('Content-Disposition: attachment;filename='.$filename);
        
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        
        $objWriter->save('php://output');
    }
}
