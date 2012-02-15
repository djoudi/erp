<div id="LoginWrapperOuter">
  <div id="LoginWrapperMiddle">
    <div id="LoginWrapperInner">
      
      <img id="LoginLogo" src="/images/logo.png"/>
      
      <form id="LoginForm" method="post" action="<?php echo url_for('@sf_guard_signin') ?>">
        
        <?php if ($form->hasErrors()): ?>
          Invalid username or password.
        <?php endif; ?>
      
        <br />
        
        <?php echo $form->renderHiddenFields()."\n"; ?>
        <?php echo $form["username"]->render(array('placeholder' => 'Username'))."\n"; ?>
        <?php echo $form["password"]->render(array('placeholder' => 'Password'))."\n"; ?>
        <input class="btn primary" type="submit" value="Login" />
        
      </form>
      
    </div>
  </div>
</div>
