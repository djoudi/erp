<div class="FilterForm well">

  <h4>
    <a class="btn info" onclick="$('#topFilterForm').toggle()">
      <i class="icon-search"></i>
      Filter Results 
    </a>
  </h4>

  <form id="topFilterForm" action="" method="post" <?php if (!$filtered): ?>style="display:none"<?php endif; ?>>
    <br />
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
