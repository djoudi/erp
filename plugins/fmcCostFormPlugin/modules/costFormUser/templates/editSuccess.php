<?php slot ('title', "Cost Form Information") ?>


<?php slot ('activeClass', "#topmenu_costforms"); ?>

    
<div class="clearfix">

    <?php include_partial('costFormDetails', array(
        'costForm' => $costForm, 
        'costFormStatus' => $costFormStatus
    )) ?>

    <div class="pull-right clearfix">
        <h4 class="pull-right clearfix">Added costs</h4>
        <div class="clearfix"></div>
        <?php include_partial('costFormItems', array(
            'costItems' => $costItems, 
            'isSent' => $costForm->isSent
        )) ?>
    </div>

</div>


    
  <?php if ( ! $costForm->isSent): ?>
    <h4>Add new cost</h4>
    <?php include_partial('costFormItemNew', array('form' => $form)) ?>
  <?php endif; ?>

<div class="form-actions">

  <?php if ( ! $costForm->isSent): ?>
    
    
    
    <?php include_partial ('fmcCore/confirmButton', array(
        'class' => 'btn btn-primary',
        'url' => url_for('costFormUser_send',array('id'=>$costForm['id'])),
        'label' => 'Finish &amp; Send',
        'text' => 'Warning! If you continue, you will NOT be able to change cost form contents and this form will be sent to Finance Department. Continue?',
        #"iconClass" => 'icon-remove icon-white'
    )); ?>
    
    <?php include_partial ('fmcCore/confirmButton', array(
        'class' => 'btn btn-danger pull-right',
        'url' => url_for('costFormUser_deleteForm',array('id'=>$costForm['id'])),
        'label' => 'Delete Cost Form',
        'text' => 'If you delete this form, all your unsaved information will be lost. Do you really want to delete your cost form?',
        #"iconClass" => 'icon-remove icon-white'
    )); ?>
    
    <a class="btn btn-success" href="<?php echo url_for('@costFormUser_list') ?>">Save</a>
    
  <?php else: ?>
    
    <a class="btn" href="<?php echo url_for('@costFormUser_list') ?>">Go Back</a>
    <a class="btn btn-info" href="<?php echo url_for('@costFormUser_report?id='.$costForm->id) ?>">Download Cost Form</a>
    
  <?php endif; ?>

</div>
