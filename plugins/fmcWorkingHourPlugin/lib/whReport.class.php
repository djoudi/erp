<?php

class whReport extends whReportParent
{
    
    private function getDaysFromDB ($start_date, $end_date)
    {
        $this->db_employeedays = Doctrine::getTable("WorkingHourday")
            ->createQuery ("whd")
            ->addWhere ("whd.employee_id = ?", $this->db_employee->getId())
            ->addwhere ("whd.date >= ?", $start_date)
            ->addWhere ("whd.date <= ?", $end_date)
            ->leftJoin ("whd.LeaveRequest lr")
            ->leftJoin ("whd.WorkingHourRecords whr")
                ->leftJoin ("whr.Project p")
                ->leftJoin ("whr.WorkType w")
            ->orderBy ("whd.date ASC, whr.start_Time ASC")
            ->fetchArray();
        
        $this->search_days = array();
        foreach (($this->db_employeedays) as $day) array_push ($this->search_days, $day["date"]);
    }
    
    
    public function BalanceResultsForDateInterval ($user_id, $startDate, $endDate)
    {
        $this->db_employee = Doctrine::getTable("sfGuardUser")->findOneById ($user_id);
        
        $this->getDaysFromDB ($startDate, $endDate);
        
        $upToDayBalanceClass = new whReport();
        $this->upToDayBalance = $upToDayBalanceClass->calculateEmployeeBalanceToDate ($user_id, $startDate);
        
        $balance = $this->calculateBalanceForDateIntervalAndEmployee (
            $startDate, $endDate, $this->db_employee, $this->db_employeedays, $this->search_days, $this->upToDayBalance, true
        );
        
        return $this->resultArray;
    }
    
    
    public function calculateEmployeeBalanceToDate ($user_id, $endDate)
    {
        $this->db_employee = Doctrine::getTable("sfGuardUser")->findOneById ($user_id);
        
        $startDate = max (array("2013-01-01", $this->db_employee->getEmploymentStart()));
        $endDate = new DateTime ($endDate);
        $endDate->sub(new DateInterval('P1D'))->format("Y-m-d"); // One day before the given end date
        $endDate = $endDate->format("Y-m-d");
        
        $this->getDaysFromDB ($startDate, $endDate);
        
        $newBalance = $this->calculateBalanceForDateIntervalAndEmployee (
            $startDate, $endDate, $this->db_employee, $this->db_employeedays, $this->search_days, 0, false
        );
        
        return $this->db_employee->getWh_balance_before_2013() + $newBalance;
    }
    
}
