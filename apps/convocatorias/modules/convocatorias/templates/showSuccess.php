<h1><?php echo $object->getGestion() ?></h1>
<p style="font-size: 18px; margin-bottom: 10px;"><?php echo '(' . $object->getEstado() . ')' ?></p>

<div id="tabber">
    <ul>
    	<li class="tab"><a href="#preview">Vista Previa</a></li>
    	<li class="tab"><a href="#editor">Edición</a></li>
    </ul>
    <div class="tab_details">
        <div id="preview" class="tab_contents">
            <a name="preview"></a>
            <div class="buttons">
                <?php echo link_to('Ver TXT', 'convocatorias_texto',
                    $object, array(
                        'target' => '_blank'
                    )
                ) ?>
                <?php echo link_to('Ver PDF', 'convocatorias_pdf',
                    $object, array(
                        'target' => '_blank'
                    )
                ) ?>
            </div>
            <div class="clear"></div>
            <?php echo $sf_data->getRaw('preview') ?>
        </div>
    	<div id="editor" class="tab_contents">
            <a name="editor"></a>
            <?php echo form_tag_for($form, '@convocatorias') ?>
                <?php echo $form ?>
                <p class="submit"><input type="submit" value="Registrar" /></p>
            </form>
        </div>
    </div>
</div>
