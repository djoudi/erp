<div class="tablesorterpagerdiv pull-left">
  
  <form>
    
    <?php if (isset($count)): ?>
      <strong><?php echo $count; ?></strong> results found. &nbsp;
    <?php endif; ?>
    
    <img src="/css/tablesorter/first.png" class="first">
    <img src="/css/tablesorter/prev.png" class="prev">
    
    <input type="text" class="pagedisplay span2" />
    
    <img src="/css/tablesorter/next.png" class="next">
    <img src="/css/tablesorter/last.png" class="last">
    
    <select class="pagesize span1">
      
      <option selected="25" value="25">25</option>
      
      <option value="50">50</option>
      <option value="100">100</option>
      
    </select> results per page
    
  </form>
  
</div>
