<div class="container">
    
    <form class="form-signin" id="LoginForm">
        
        <div class="logo-wrapper">
            <img id="LoginLogo" src="/img/logo.png"/>
        </div>
        
        <h4>Error: Page Not Found.</h4>
        
        <p>
            The page you wanted to access either does not exist or record could not be retrieved.
        </p>
        <p>
            If you think you get this message by error, please contact your system administrator.
        </p>
        
        <a class="btn btn-primary" href="<?php echo url_for("@homepage"); ?>">
            Go back to homepage
        </a>
        
        <div class="clearfix"></div>
        
    </form>

</div>
