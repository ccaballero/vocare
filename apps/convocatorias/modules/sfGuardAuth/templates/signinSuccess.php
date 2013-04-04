<h1><?php echo __('Signin') ?></h1>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
      <?php echo $form ?>
    <p class="submit">
        <input type="submit" value="<?php echo __('Signin') ?>" />
    </p>
          
    <p class="submit">
        <?php $routes = $sf_context->getRouting()->getRoutes() ?>
    <?php if (isset($routes['sf_guard_forgot_password'])): ?>
        <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?') ?></a>&nbsp;
    <?php endif; ?>
    <?php if (isset($routes['sf_guard_register'])): ?>
        <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?') ?></a>
    <?php endif; ?>
    </p>
</form>
