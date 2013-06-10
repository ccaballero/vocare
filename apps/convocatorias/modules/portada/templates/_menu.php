<ul>
    <li><?php echo link_to(
            __('Homepage'), '@homepage', array('accesskey' => '1')
            ) ?></li>

<?php if ($sf_user->hasCredential('convocatorias_list')): ?>
    <li><?php echo link_to(
            __('Requests'), '@convocatorias', array('accesskey' => '2')
            ) ?></li>
<?php else: ?>
    <li><?php echo link_to(
            __('Requests'), 'portada/convocatorias', array('accesskey' => '2')
            ) ?></li>
<?php endif; ?>

<?php if ($sf_user->hasCredential('usuarios_list')): ?>
    <li><?php echo link_to(
            __('Staff'), 'portada/personal', array('accesskey' => '3')
            ) ?></li>
<?php endif; ?>
</ul>
