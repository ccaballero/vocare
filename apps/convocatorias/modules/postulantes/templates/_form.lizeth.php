<div class="marco"> 
    <h3 class="text-center">Formulario de Postulacion a la Convocatoria </h3>
    <h3 class="text-center"><?php echo $gestion; ?></h3>
    <?php echo form_tag_for($form, '@postulaciones') ?>
    <table class="text-center">
        <tbody>
            <?php echo $form['nombre']->renderRow() ?>
            <?php echo $form['apellido_paterno']->renderRow() ?>
            <?php echo $form['apellido_materno']->renderRow() ?>
            <?php echo $form['ci']->renderRow() ?>
            <?php echo $form['cod_sis']->renderRow() ?>
            <?php echo $form['email']->renderRow() ?>
            <?php echo $form['telefono']->renderRow() ?>
            <?php echo $form['direccion']->renderRow() ?>
            <?php echo $form['requerimiento_list']->renderRow() ?>
            <?php echo $form['numero_hojas']->renderRow() ?>

            <!-- Renderiza los campos ocultos del formulario -->
            <?php echo $form->renderHiddenFields() ?>
        </tbody>
    </table>
    <p class="submit">
        <input type="submit" value="Enviar formulario" />
    </p>

</div>