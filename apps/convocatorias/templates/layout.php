<!DOCTYPE html PUBLIC
    "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link rel="shortcut icon" href="../../img/vocare.png" />
        <?php include_javascripts() ?>
        
        <?php sfContext::getInstance()->getResponse()->removeStylesheet('/sfDoctrinePlugin/css/global.css'); ?>
        
        <?php include_stylesheets() ?>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
    </head>
    <body>
        <div id="menu">
            <div class="left"><?php include_partial('portada/menu') ?></div>
            <div class="right"><?php include_partial('portada/toolbar') ?></div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div id="content">
            <div id="main">
                <?php include_partial('portada/messages') ?>
                <?php echo $sf_content ?>
            </div>
            <div id="footer"><?php include_partial('portada/footer') ?></div>
        </div>
    </body>
</html>
