<?php
    slot ('title', "My Working Hour Reports");
    slot ('activeClass', "#topmenu_workinghours");
?>


<ul id="myTab" class="nav nav-tabs">
    <li class="active">
        <a href="#tab1" data-toggle="tab">
            Work Records: This Week
        </a>
    </li>
    <li>
        <a href="#tab2" data-toggle="tab">
            Work Records: This Month
        </a>
    </li>
    <li>
        <a href="#tab3" data-toggle="tab">
            Work Records: All
        </a>
    </li>
</ul>


<div id="myTabContent" class="tab-content">
    
    <div class="tab-pane in active" id="tab1">
        <?php include_partial ("workAll", array(
            "startDate" => $weekWorkStartDate,
            "lastBalance" => $weekWorkLastBalance,
            "results" => $weekWork
        )); ?>
    </div>
    
    <div class="tab-pane" id="tab2">
        <?php include_partial ("workAll", array(
            "startDate" => $monthWorkStartDate,
            "lastBalance" => $monthWorkLastBalance,
            "results" => $monthWork
        )); ?>
    </div>
    
    <div class="tab-pane" id="tab3">
        <?php include_partial ("workAll", array(
            "startDate" => $allWorkStartDate,
            "lastBalance" => $allWorkLastBalance,
            "results" => $allWork
        )); ?>
    </div>
    
</div>
