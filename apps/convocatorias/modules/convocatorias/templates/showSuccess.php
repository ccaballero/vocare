<h1><?php echo $object->getGestion() ?></h1>
<p><?php echo '(' . $object->getEstado() . ')' ?></p>

<div id="tabber">
    <ul id="tabs">
    <?php if ($view_preview): ?>
    	<li class="tab"><a href="#preview">Vista Previa</a></li>
    <?php endif; ?>
    <?php if ($view_editor && $sf_user->hasCredential('convocatorias_edit')): ?>
    	<li class="tab"><a href="#editor">Edición</a></li>
    <?php endif; ?>
    <?php if ($view_redaction): ?>
    	<li class="tab"><a href="#redaction">Redacción</a></li>
    <?php endif; ?>
    <?php if ($view_viewers): ?>
    	<li class="tab"><a href="#viewers">Notificaciones</a></li>
    <?php endif; ?>
    <?php if ($view_users): ?>
    	<li class="tab"><a href="#users">Encargados</a></li>
    <?php endif; ?>
    <?php if ($view_results): ?>
    	<li class="tab"><a href="#results">Resultados</a></li>
    <?php endif; ?>
    </ul>
    <div class="tab_details">
    <?php if ($view_preview): ?>
        <div id="preview" class="tab_contents">
            <a name="preview"></a>
            <?php include_partial('convocatorias/preview', array(
                'object' => $object,
                'preview' => $preview,
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($view_editor
          && $sf_user->hasCredential('convocatorias_create')): ?>
    	<div id="editor" class="tab_contents">
            <a name="editor"></a>
            <?php echo form_tag_for($form, '@convocatorias') ?>
                <?php echo $form ?>
                <p class="submit"><input type="submit" value="Registrar" /></p>
            </form>
        </div>
    <?php endif; ?>
    <?php if ($view_redaction): ?>
        <div id="redaction" class="tab_contents">
            <a name="redaction"></a>
            <?php include_partial('convocatorias/redactions', array(
                'object' => $object,
                'list' => $list,
                'redaction' => $redaction,
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($view_viewers): ?>
        <div id="viewers" class="tab_contents">
            <a name="viewers"></a>
            <?php include_partial('convocatorias/notifications', array(
                'object' => $object,
                'signatures' => $signatures,
                'notifications' => $notifications,
            )) ?>
        </div>
    <?php endif; ?>
    <?php if ($view_users): ?>
        <div id="users" class="tab_contents">
            <a name="users"></a>
            <p>En esta página puede usted establecer el conjunto de personas
            encargadas del correcto desempeño en el proceso de ejecución de su
            convocatoria.</p>
    <?php endif; ?>
    <?php if ($view_results): ?>
        <div id="results" class="tab_contents">
            <a name="users"></a>
            <h1>Resultados</h1>
        </div>
    <?php endif; ?>
    </div>
</div>
