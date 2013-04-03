<h1><?php echo __('Signin') ?></h1>

<form method="" action="<?php echo url_for('@sf_guard_signin') ?>">
    <?php echo $form ?>
    <p class="submit">
        <input type="submit" value="<?php echo __('Signin', null, 'sf_guard.es') ?>" />
    </p>
    <p class="submit">
        <?php $routes = $sf_context->getRouting()->getRoutes() ?>
    <?php if (isset($routes['sf_guard_forgot_password'])): ?>
        <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard.es') ?></a>&nbsp;
    <?php endif; ?>

    <?php if (isset($routes['sf_guard_register'])): ?>
        <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?', null, 'sf_guard.es') ?></a>
    <?php endif; ?>
    </p>
</form>
