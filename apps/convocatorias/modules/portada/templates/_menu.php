<ul>
    <li><?php echo link_to(
            __('Homepage'), '@homepage', array('accesskey' => '1')
            ) ?></li>
<?php if ($sf_user->hasCredential('Listar convocatorias')): ?>
    <li><?php echo link_to(
            __('Requests'), url_for('convocatorias'), array('accesskey' => '2')
            ) ?></li>
<?php endif; ?>
<?php if ($sf_user->hasCredential('Listar usuarios')): ?>
    <li><?php echo link_to(
            __('Users'), 'portada/usuarios', array('accesskey' => '3')
            ) ?></li>
<?php endif; ?>
</ul>
