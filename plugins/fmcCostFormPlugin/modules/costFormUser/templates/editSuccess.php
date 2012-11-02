<?php slot ('title', "Cost Form Information") ?>


<script type="text/javascript">
    $("#topmenu_costforms").addClass("active");
</script>

    


<?php include_partial('costFormDetails', array(
    'costForm' => $costForm, 
    'costFormStatus' => $costFormStatus
)) ?>

<div class="pull-right">

    <h4 class="pull-right">Added costs</h4>

    <div class="clearfix"></div>
    
    <?php include_partial('costFormItems', array(
        'costItems' => $costItems, 
        'isSent' => $costForm->isSent
    )) ?>

</div>


    <div class="clearfix"></div>
    
    
  <?php if ( ! $costForm->isSent): ?>
    <h4>Add new cost</h4>
    <?php include_partial('costFormItemNew', array('form' => $form)) ?>
  <?php endif; ?>

<div class="form-actions">

  <?php if ( ! $costForm->isSent): ?>
  
    <a class="btn btn-primary" onclick="
      if (confirm('Warning! If you continue, you will NOT be able to change cost form contents and this form will be sent to Finance Department. Continue?')) 
        window.location='<?php echo url_for('@costFormUser_send?id='.$costForm->id) ?>'
    ">Finish &amp; Send</a>
  
    <a class="btn btn-danger pull-right" onclick="
      if (confirm('If you delete this form, all your unsaved information will be lost. Do you really want to delete your cost form?'))
        parent.location='<?php echo url_for('@costFormUser_deleteForm?id='.$costForm->id) ?>'
    ">Delete Cost Form</a>
    
    <a class="btn btn-success" href="<?php echo url_for('@costFormUser_list') ?>">Save</a>
    
  <?php else: ?>
    
    <a class="btn" href="<?php echo url_for('@costFormUser_list') ?>">Go Back</a>
    <a class="btn btn-info" href="<?php echo url_for('@costFormUser_report?id='.$costForm->id) ?>">Download Cost Form</a>
    
  <?php endif; ?>

</div>
