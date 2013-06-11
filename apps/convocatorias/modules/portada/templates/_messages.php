<?php if ($sf_user->hasFlash('success')): ?>
    <div id="messages" class="success">
        <div class="close"><a href="">x</a></div>
        <p><?php echo $sf_user->getFlash('success') ?></p>
    </div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('notice')): ?>
    <div id="messages" class="notice">
        <div class="close"><a href="">x</a></div>
        <p><?php echo $sf_user->getFlash('notice') ?></p>
    </div>
<?php endif; ?>
    
<?php if ($sf_user->hasFlash('error')): ?>
    <div id="messages" class="error">
        <div class="close"><a href="">x</a></div>
        <p><?php echo $sf_user->getFlash('error') ?></p>
    </div>
<?php endif; ?>
