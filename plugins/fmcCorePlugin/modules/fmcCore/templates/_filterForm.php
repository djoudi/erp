<div class="FilterForm well" style="padding: 10px !important;">

  <a class="btn info" onclick="$('#topFilterForm').toggle()">
    <i class="icon-search"></i>
    Filter Results 
  </a>

  <form id="topFilterForm" action="" method="post" <?php if (!$filtered): ?>style="display:none"<?php endif; ?>>
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
