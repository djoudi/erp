<?php if (isset($title)) slot ('title', $title); ?>


<?php if (isset($activeClass)): ?>

    <script type="text/javascript">
        $("<?php echo $activeClass; ?>").addClass("active");
    </script>

<?php endif; ?>


<form method="post" class="form-horizontal">

    <table class="table table-hover table-bordered table-condensed">
        
        <?php echo $form; ?>
        
    </table>

    <div class="form-actions">
        
        <a class="btn" href="<?php echo $back_url; ?>">Back to List</a>
        
        <input class="btn btn-primary" type="submit" value="Save" />
        
        <input class="btn pull-right" type="reset" value="Reset Values" />
        
    </div>

</form>
