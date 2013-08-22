<h1>Modificación de los datos del postulante</h1>
<form method="post" action="<?php echo url_for('postulantes_edit', array(
    'convocatoria' => $convocatoria->getId(),
    'id' => $object->getId(),
)) ?>">
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
