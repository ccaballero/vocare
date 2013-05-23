<h1><?php echo __('Forgot your password?') ?></h1>

<p>Asi que olvidasteis vuestra contraseña, eso demuestra muy poco interes o una
muy entristeciente personalidad desorganizada. Desgraciadamente, para la
humanidad, somos muchos los que olvidamos alguna cosilla de vez en cuando, mas
aún cuando es insignificante como este miserable sitio web.</p>

<p>Tal es la lucha por ser un olvidadizo en este mundo caotico, que hace tiempo
se crearon medios para nosotros, los no iniciados en estos caminos directos.
Asi que eso es lo que hace exactamente esta pagina, solo necesitais escribir el
correo electronico (si es que no olvidaste eso), en el campo mostrado más
abajo.</p>

<p>Una vez enviado el formulario, te enviaremos una correo electronico (no me
digas!), con la información necesaria para recuperar tu contraseña.</p>

<form action="<?php echo url_for('@sf_guard_forgot_password') ?>" method="post">
    <table><?php echo $form ?></table>
    <p class="submit">
        <input type="submit" name="change" value="<?php echo __('Request') ?>" />
    </p>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        $('#forgot_password_email_address').focus();
    });
</script>
