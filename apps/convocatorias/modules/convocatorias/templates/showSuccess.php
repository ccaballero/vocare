<h1><?php echo $object->getGestion() ?></h1>
<p style="font-size: 18px; margin-bottom: 10px;"><?php echo '(' . $object->getEstado() . ')' ?></p>

<div id="tabber">
    <ul>
    <?php if ($view_preview): ?>
    	<li class="tab"><a href="#preview">Vista Previa</a></li>
    <?php endif; ?>
    <?php if ($view_editor): ?>
    	<li class="tab"><a href="#editor">Edición</a></li>
    <?php endif; ?>
    <?php if ($view_redaction): ?>
    	<li class="tab"><a href="#redaction">Redacción</a></li>
    <?php endif; ?>
    <?php if ($view_users): ?>
    	<li class="tab"><a href="#users">Cargos</a></li>
    <?php endif; ?>
    <?php if ($view_results): ?>
    	<li class="tab"><a href="#results">Resultados</a></li>
    <?php endif; ?>
    </ul>
    <div class="tab_details">
    <?php if ($view_preview): ?>
        <div id="preview" class="tab_contents">
            <a name="preview"></a>
            <div class="buttons">
                <ul>
                    <li>
                        <?php echo link_to(image_tag('/img/page_white.png'), 'convocatorias_texto',
                            $object, array('target' => '_blank')) ?>
                    </li>
                    <li>
                        <?php echo link_to(image_tag('/img/page_white_acrobat.png'), 'convocatorias_pdf',
                            $object, array('target' => '_blank')) ?>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
            <?php if ($preview <> null): ?>
                <?php echo $sf_data->getRaw('preview') ?>
            <?php else: ?>
                <p>No se definió aún una redacción del texto para este borrador de convocatoria.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ($view_editor): ?>
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
            <?php echo form_tag(url_for('convocatorias_redaccion', array('id' => $object->getId()))) ?>
                <p><textarea name="redaction" class="full-area"><?php echo $redaction ?></textarea></p>
                <p class="submit"><input type="submit" value="Registrar" /></p>
            </form>
        </div>
    <?php endif; ?>
    <?php if ($view_users): ?>
        <div id="users" class="tab_contents">
            <a name="users"></a>
            <p>En esta página puede usted establecer el conjunto de personas encargadas del correcto
            desempeño en el proceso de ejecución de su convocatoria</p>
        </div>
    <?php endif; ?>
    <?php if ($view_results): ?>
        <div id="results" class="tab_contents">
            <a name="users"></a>
            <h1>Resultados</h1>
        </div>
    <?php endif; ?>
    </div>
</div>
