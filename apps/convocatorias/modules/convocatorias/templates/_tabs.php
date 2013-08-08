<ul id="tabs">
    <?php if ($tabs['preview']): ?>
    	<li class="tab"><a href="#preview">Vista Previa</a></li>
    <?php endif; ?>
    <?php if ($tabs['editor']
          && $sf_user->hasCredential('convocatorias_edit')): ?>
    	<li class="tab"><a href="#editor">Edición</a></li>
    <?php endif; ?>
    <?php if ($tabs['redactions']): ?>
    	<li class="tab">
            <a href="#redactions">
                Redacción
                <?php echo image_state($object->validateRedaction()) ?>
            </a>
        </li>
    <?php endif; ?>
    <?php if ($tabs['notifications']): ?>
    	<li class="tab">
            <a href="#notifications">
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
    <?php if ($tabs['postulants']): ?>
        <li class="tab">
            <a href="#postulants">Postulaciones</a>
        </li>
    <?php endif; ?>
    <?php if ($tabs['results']): ?>
    	<li class="tab">
            <a href="#results">Resultados</a>
        </li>
    <?php endif; ?>
</ul>
