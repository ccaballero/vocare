<div id="tabber">
    <?php include_partial('documentacion/tabs', array(
        'object' => $object,
    )) ?>

    <div class="tab_details">
        <div id="preview" class="tab_contents">
            <a name="preview"></a>
            <?php include_partial('documentacion/tasks', array(
                'object' => $object,
            )) ?>
            <?php include_partial('documentacion/preview', array(
                'object' => $object,
                'previews' => $previews,
            )) ?>
            
            <div class="clear"></div>
        </div>
    	<div id="editor" class="tab_contents">
            <a name="editor"></a>
            <?php // echo form_tag_for($form, '@convocatorias') ?>
                <?php // echo $form ?>
                <p class="submit"><input type="submit" value="Registrar" /></p>
            </form>
        </div>
    </div>
</div>
