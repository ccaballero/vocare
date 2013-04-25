<h1><?php echo $object->getGestion() ?></h1>
<p style="font-size: 18px; margin-bottom: 10px;"><?php echo '(' . $object->getEstado() . ')' ?></p>

<div id="tabber">
    <ul>
    	<li class="tab"><a href="#preview">Vista Previa</a></li>
    	<li class="tab"><a href="#editor">Edición</a></li>
    	<li class="tab"><a href="#redaction">Redacción</a></li>
    </ul>
    <div class="tab_details">
        <div id="preview" class="tab_contents">
            <a name="preview"></a>
            <div class="buttons">
                <ul>
                    <li>
                        <?php echo link_to(image_tag('/img/page_white.png'), 'convocatorias_texto',
                            $object, array(
                                'target' => '_blank'
                            )
                        ) ?>
                    </li>
                    <li>
                        <?php echo link_to(image_tag('/img/page_white_acrobat.png'), 'convocatorias_pdf',
                            $object, array(
                                'target' => '_blank'
                            )
                        ) ?>
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
    	<div id="editor" class="tab_contents">
            <a name="editor"></a>
            <?php echo form_tag_for($form, '@convocatorias') ?>
                <?php echo $form ?>
                <p class="submit"><input type="submit" value="Registrar" /></p>
            </form>
        </div>
        <div id="redaction" class="tab_contents">
            <a name="redaction"></a>
            <?php echo form_tag(
                url_for('@convocatorias_redaccion', array('id' => 1))
            ) ?>
                <p><textarea name="redaction" class="full-area"><?php echo $redactions[$max_enmienda] ?></textarea></p>
                <p class="submit"><input type="submit" value="Registrar" /></p>
            </form>
        </div>
    </div>
</div>
