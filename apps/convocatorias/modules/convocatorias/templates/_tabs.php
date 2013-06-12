<ul id="tabs">
    <?php if ($tabs['preview']): ?>
    	<li class="tab"><a href="#preview">Vista Previa</a></li>
    <?php endif; ?>
    <?php if ($tabs['editor']
          && $sf_user->hasCredential('convocatorias_edit')): ?>
    	<li class="tab"><a href="#editor">Edición</a></li>
    <?php endif; ?>
    <?php if ($tabs['redaction']): ?>
    	<li class="tab">
            <a href="#redaction">
                Redacción
                <?php echo image_state($object->validateRedaction()) ?>
            </a>
        </li>
    <?php endif; ?>
    <?php if ($tabs['viewers']): ?>
    	<li class="tab">
            <a href="#viewers">
                Notificaciones
                <?php echo image_state($object->validateNotification()) ?>
            </a>
        </li>
    <?php endif; ?>
    <?php if ($tabs['users']): ?>
    	<li class="tab">
            <a href="#users">
                Encargados
                <?php echo image_state($object->validateEncargados()) ?>
            </a>
        </li>
    <?php endif; ?>
    <?php if ($tabs['letters']): ?>
        <li class="tab"><a href="#letters">Cartas</a></li>
    <?php endif; ?>
    <?php if ($tabs['results']): ?>
    	<li class="tab"><a href="#results">Resultados</a></li>
    <?php endif; ?>
</ul>
