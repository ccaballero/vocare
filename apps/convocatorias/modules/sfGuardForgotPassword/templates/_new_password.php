<p>Saludos repetidos <?php echo $user->getFirstName() ?>,</p>

<p>A continuación adjuntamos la informacion de acceso al sitio, asi la proxima
vez que pierdas la contraseña de será mas facil el acceso.</p>

<p><?php echo __('Username') ?>: <?php echo $user->getUsername() ?></p>
<p><?php echo __('Password') ?>: <?php echo $password ?></p>
