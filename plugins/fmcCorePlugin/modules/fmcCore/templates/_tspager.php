<div class="tablesorterpagerdiv pull-left">
  
    <form class="form-inline" style="margin: 0px">
    
        <?php if (isset($count)): ?>
            <strong><?php echo $count; ?></strong> results found. &nbsp;
        <?php endif; ?>
    
        <img src="/img/first.png" class="first">
        <img src="/img/prev.png" class="prev">
        
        <input type="text" class="pagedisplay span2" />
        
        <img src="/img/next.png" class="next">
        <img src="/img/last.png" class="last">
        
        <select class="pagesize span1">
            
            <option value="100">100</option>
            <option selected="250" value="250">250</option>
            <option value="1000">1000</option>
        
        </select> results per page
        
    </form>
  
</div>
