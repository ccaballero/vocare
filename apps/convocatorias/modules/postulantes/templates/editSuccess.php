<div class="marco">
<?php if ($form['estado']->getValue() == 'Inscrito') { ?>
            <h3 class="text-center"> Revision de Documentos</h3> 
        <?php } else { ?>
            <h3 class="text-center"> Recepcion y Modificacion de Formularios</h3> 
        <?php } ?>
            <?php echo form_tag_for($form, '@postulaciones') ?>
            <p>
                <?php echo $form['nombre']->renderRow() ?>
                <?php echo $form['apellido_paterno']->renderRow() ?>
                <?php echo $form['apellido_materno']->renderRow(); ?>
            </p>
            <?php echo $form['requerimiento_list']->renderRow() ?>
            <?php echo $form['ci']->renderRow() ?>
            <?php echo $form['cod_sis']->renderRow() ?>
            <?php echo $form['email']->renderRow() ?>
            <?php echo $form['telefono']->renderRow() ?>
            <?php echo $form['direccion']->renderRow() ?>
            <?php echo $form['numero_hojas']->renderRow() ?>
        <?php
        if ($form['estado']->getValue() == 'Inscrito') { ?>
            <div class="text-justify">
                <?php echo $form['requisito_list']->renderRow(); ?>
                <?php echo $form['documento_list']->renderRow(); ?>
            </div>
        <?php } ?>
        <?php echo $form['estado']->renderRow() ?>
        <?php echo $form['observacion']->renderRow() ?>

        <?php echo $form->renderHiddenFields() ?>
<?php if($form['estado']->getValue() == 'Inscrito'){ ?>
            <p class="submit">
            <input type="submit" id="revisar" value="Terminar" />
        </p>
<?php }else{?>
        <p class="submit">
            <input type="submit" id="recivir" value="Terminar" />
        </p>
        <?php }?>
</div>

