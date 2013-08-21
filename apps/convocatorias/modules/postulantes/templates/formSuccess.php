<h1>Modificación de los datos del postulante</h1>
<?php echo form_tag_for($form, '@postulantes') ?>
    <?php echo $form ?>
    <p class="submit">
        <input type="submit"
            value="<?php echo $form->isNew() ? 'Registrar' : 'Modificar'?>" />
        &nbsp;<?php echo link_to('Volver a la lista',
            url_for('postulantes',
                array(
                    'convocatoria' => $convocatoria->getId(),
        ))) ?>
    </p>
</form>
