<h1>Solicitud de cambio de contraseña</h1>

<p>Ingresa tu nueva contraseña en el formulario siguiente:</p>

<form action="<?php echo url_for('@sf_guard_forgot_password_change?unique_key='.$sf_request->getParameter('unique_key')) ?>"
      method="post">
    <?php echo $form ?>
    <p class="submit">
        <input type="submit" name="change" value="<?php echo __('Change') ?>" />
    </p>
</form>