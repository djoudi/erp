<!DOCTYPE html>
<html lang="<?php echo $sf_user->getCulture() ?>">
    <head>
        <?php include_http_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <?php echo $sf_content ?>
    </body>
</html>
