
<?php if ($sf_user->hasFlash('success')): ?>
  <div class="alert alert-success">
    <a class="close" onclick="$(this).parent().hide()">×</a>
    <p><?php echo $sf_user->getFlash('success') ?></p>
  </div>
<?php endif ?>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="alert">
    <a class="close" onclick="$(this).parent().hide()">×</a>
    <p><?php echo $sf_user->getFlash('notice') ?></p>
  </div>
<?php endif ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="alert alert-error">
    <a class="close" onclick="$(this).parent().hide()">×</a>
    <p><?php echo $sf_user->getFlash('error') ?></p>
  </div>
<?php endif ?>
