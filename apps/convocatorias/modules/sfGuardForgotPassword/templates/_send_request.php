<p>Saludos <?php echo $user->getFirstName() ?>,</p>

<p>Este correo electrónico es la respuesta a tu petición de reinicio de tu
contraseña.</p>
<p>Tu puedes cambiar tu contraseña haciendo click en el enlace de abajo el cual
es solamente valido por 24 horas a partir del momento en que hiciste la
petición.</p>

<?php echo link_to(
    __('Click to change password'),
    '@sf_guard_forgot_password_change?unique_key='
        . $forgot_password->unique_key, 'absolute=true')
?>
