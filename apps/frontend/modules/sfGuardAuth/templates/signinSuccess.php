<div class="container">
    
    <form class="form-signin" id="LoginForm" method="post" action="<?php echo url_for('@sf_guard_signin') ?>">
        
        <?php echo $form->renderHiddenFields()."\n"; ?>
        
        <div class="logo-wrapper">
            <img id="LoginLogo" src="/img/logo.png"/>
        </div>
        
        <?php if ($form->hasErrors()): ?>
            <div class="alert">
                Invalid username or password.
            </div>
        <?php endif; ?>
        
        <?php echo $form["username"]->render(array('placeholder' => 'Username','class'=>'input-block-level'))."\n"; ?>
        
        <?php echo $form["password"]->render(array('placeholder' => 'Password','class'=>'input-block-level'))."\n"; ?>
        
        <button class="btn btn-primary" type="submit">Sign in</button>
        
        <div class="clearfix"></div>
        
      </form>

</div>
