<ul>
    <li><?php echo link_to(__('Homepage'), '@homepage') ?></li>
    <li><?php echo link_to(__('Requests'), url_for('convocatorias')) ?></li>
    <li><?php echo link_to(__('Templates'), url_for('portada/plantillas')) ?></li>
    <li><?php echo link_to(__('Usuarios'), '@sf_guard_user') ?></li>
</ul>
