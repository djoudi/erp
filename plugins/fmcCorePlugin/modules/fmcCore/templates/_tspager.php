<div class="tablesorterpagerdiv pull-left">
  
    <form>
    
        <?php if (isset($count)): ?>
            <strong><?php echo $count; ?></strong> results found. &nbsp;
        <?php endif; ?>
    
        <img src="/addons/tablesorter/images/first.png" class="first">
        <img src="/addons/tablesorter/images/prev.png" class="prev">
        
        <input type="text" class="pagedisplay span2" />
        
        <img src="/addons/tablesorter/images/next.png" class="next">
        <img src="/addons/tablesorter/images/last.png" class="last">
        
        <select class="pagesize span1">
            
            <option value="25">25</option>
            <option selected="50" value="50">50</option>
            <option value="100">100</option>
        
        </select> results per page
        
    </form>
  
</div>
