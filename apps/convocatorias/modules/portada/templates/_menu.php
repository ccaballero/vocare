<ul>
    <li><?php echo link_to(__('Homepage'), '@homepage') ?></li>
<?php if ($sf_user->hasCredential('Listar convocatorias')): ?>
    <li><?php echo link_to(__('Requests'), url_for('convocatorias')) ?></li>
<?php endif; ?>
<?php if ($sf_user->hasCredential('Listar usuarios')): ?>
    <li><?php echo link_to(__('Users'), 'portada/usuarios') ?></li>
<?php endif; ?>
</ul>
