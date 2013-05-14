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
                        <?php echo link_to(
                            image_tag('/img/page_white.png'),
                            'convocatorias_texto',
                            $object, array('target' => '_blank')) ?>
                    </li>
                    <li>
                        <?php echo link_to(
                            image_tag('/img/page_white_acrobat.png'),
                            'convocatorias_pdf',
                            $object, array('target' => '_blank')) ?>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
            <?php if ($preview <> null): ?>
                <?php echo $sf_data->getRaw('preview') ?>
            <?php else: ?>
                <p>No se definió aún una redacción del texto para este borrador
                de convocatoria.</p>
            <?php endif; ?>
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
            <p>La redacción del documento, le permite modificar partes del
            texto resultante de la creación de una convocatoria, para modificar
            el texto, este debe escribirse en formato xhtml, y usarse comodines
            para la inserción dinamica de sus componentes. Como ya de entrada se
            ve complejo, se escribio ademas un ayudante, para que se pueda
            copiar el texto de una convocatoria anterior, y asi de esa forma no
            complicarse tanto la vida, y aun tener toda la potencia de un
            generador de plantillas muy versatil.</p>

            <div class="tree">
                <h1>Modelos de redacción</h1>
                <script type="text/javascript">var redacciones = {};</script>
            <?php if (count($list) == 0): ?>
                <p>No se encontro ningun modelo de redacción utilizable.</p>
            <?php else: ?>
                <ul>
                <?php foreach ($list as $convocatoria): ?>
                    <li>
                        <span class="title">
                            <?php echo $convocatoria['gestion'] ?>
                        <?php if (!empty($convocatoria['numero_enmienda'])): ?>
                            (#<?php echo $convocatoria['numero_enmienda'] ?>)
                        <?php endif; ?>
                        </span>
                        <ul class="options">
                            <li><?php echo link_to('Ver',
                                url_for('convocatorias_show',
                                    array('id' => $convocatoria['id'])
                                ),
                                array('target' => '_blank')
                            ) ?></li>                                
                            <li>
                                <a class="clipboard"
                        name="red<?php echo $convocatoria['id'] ?>">Copiar</a>
                                <script type="text/javascript">
                        redacciones["red<?php echo $convocatoria['id'] ?>"]=
                        <?php echo json_encode($convocatoria['redaccion']) ?>;
                                </script>
                            </li>
                        </ul>
                    </li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            </div>

            <?php echo form_tag(
                url_for('convocatorias_redaccion',
                array('id' => $object->getId()))) ?>
                <p><textarea name="redaction" 
                   class="middle-area"><?php echo $redaction ?></textarea></p>
                <p class="submit"><input type="submit" value="Registrar" /></p>
            </form>
        </div>
    <?php endif; ?>
    <?php if ($view_users): ?>
        <div id="users" class="tab_contents">
            <a name="users"></a>
            <p>En esta página puede usted establecer el conjunto de personas
            encargadas del correcto desempeño en el proceso de ejecución de su
            convocatoria.</p>
            <div>
                <h2>Firmas</h2>
                
            </div>
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
