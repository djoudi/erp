<div class="FilterForm well" style="padding: 10px !important;">

  <?php if(isset($count)): ?>
    <?php include_partial ('fmcCore/tspager', array('count'=>$count)); ?>
  <?php endif; ?>
  
  <?php if ($filtered): ?>
    
    <a class="btn btn-primary pull-right" onclick="$('#topFilterForm').toggle()" style="margin: 0 5px;">
      <i class="icon-search icon-white"></i>
      Open/Close Filter
    </a>
    
    <form action="" method="post" <?php if (!$filtered): ?>style="display:none"<?php endif; ?>>
      <?php echo $filter->renderHiddenFields(); ?>
      <input class="btn btn-primary pull-right" type="submit" name="_reset" value="Show All Results" />
    </form>
    
  <?php else: ?>
    <a class="btn btn-primary pull-right" onclick="$('#topFilterForm').toggle()">
      <i class="icon-search icon-white"></i>
      Filter Results 
    </a>
  <?php endif; ?>
  
  <div style="clear: both;"></div>
  
  <form id="topFilterForm" action="" method="post" style="display:none">
    <table class="table table-striped table-bordered table-condensed">
      <?php echo $filter; ?>
      <tr>
        <td></td>
        <td style="text-align: right;">
          <input class="btn" type="submit" name="_reset" value="Show All" />
          <input class="btn btn-info" type="submit" value="Filter" />&nbsp;
        </td>
      </tr>
    </table>
  </form>

</div>
