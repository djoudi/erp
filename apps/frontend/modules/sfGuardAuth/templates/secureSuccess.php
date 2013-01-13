<div class="container">
    
    <form class="form-signin" id="LoginForm">
        
        <div class="logo-wrapper">
            <img id="LoginLogo" src="/img/logo.png"/>
        </div>
        
        <h4>Error!</h4>
        
        <p>
            Your account does not have proper credentials to view this page.
        </p>
        
        <p>
            If you think you have received this message by mistake, please logout and login again. 
        </p>
        
        <p>
            If problem still exists, please contact your system administrator.
        </p>
        
        <a class="btn btn-primary" href="<?php echo url_for("@homepage"); ?>">
            Go back to homepage
        </a>
        
        <div class="clearfix"></div>
        
    </form>

</div>
