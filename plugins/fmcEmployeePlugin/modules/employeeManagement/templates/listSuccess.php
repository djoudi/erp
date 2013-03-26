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


<ul class="nav nav-tabs">
    <li class="active"><a href="#active" data-toggle="tab">Active Employees</a></li>
    <li><a href="#inactive" data-toggle="tab">Inactive Employees</a></li>
</ul>


<div class="tab-content">
    <div class="tab-pane in active" id="active">
        <?php include_partial ("list", array("items"=>$activeEmployees, "is_inactive"=>false)); ?>
    </div>
    <div class="tab-pane" id="inactive">
        <?php include_partial ("list", array("items"=>$inactiveEmployees)); ?>
    </div>
</div>
