<?php slot ('title', "Employee List") ?>


<?php slot ('activeClass', "#topmenu_settings"); ?>


<p>
    <a class="btn btn-primary" href="<?php echo url_for('employeeManagement_new'); ?>">
        New Employee
    </a>
</p>


<div class="pull-right">
    <strong>Find : </strong>

    <?php include_partial ('fmcCore/typeahead', array(
        'items' => $allEmployees,
        'url' => '@employeeManagement_edit?id=',
        'class' => "employeeTypeahead",
        'col1' => "first_name",
        'seperator' => " ",
        'col2' => "last_name",
    )); ?>
</div>


<ul id="myTab" class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">Active Employees</a></li>
    <li><a href="#profile" data-toggle="tab">Inactive Employees</a></li>
</ul>


<div id="myTabContent" class="tab-content">
    <div class="tab-pane in active" id="home">
        <?php include_partial ("list", array("items"=>$activeEmployees)); ?>
    </div>
    <div class="tab-pane" id="profile">
        <?php include_partial ("list", array("items"=>$inactiveEmployees)); ?>
    </div>
</div>
