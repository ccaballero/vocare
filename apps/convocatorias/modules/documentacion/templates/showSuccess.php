<h1><?php echo $object ?></h1>

<div id="tabber">
    <?php include_partial('documentacion/tabs', array(
        'object' => $object,
    )) ?>

    <div class="tab_details">
        <div id="preview" class="tab_contents">
            <a name="preview"></a>
            <?php include_partial('documentacion/tasks', array(
                'object' => $object,
                'previews' => $previews,
            )) ?>
            <?php include_partial('documentacion/preview', array(
                'object' => $object,
                'previews' => $previews,
            )) ?>
            <div class="clear"></div>
        </div>
    	<div id="editor" class="tab_contents">
            <a name="editor"></a>
            <form method="post"
                  id="documentation_form"
                  action="<?php echo url_for(
                    'documentacion_editar', array(
                        'id' => $object->getId()
                    )) ?>">
                <?php include_partial('documentacion/editor', array(
                    'object' => $object,
                    'documents' => $documents,
                )) ?>
                <p class="submit">
                    <input name="documentation"
                           type="submit"
                           value="Registrar" />
                </p>
            </form>
        </div>
    </div>
</div>
