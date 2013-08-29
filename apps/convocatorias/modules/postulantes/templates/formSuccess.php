<h1><?php echo $title ?></h1>

<form method="post" action="<?php echo url_for($url, array(
    'convocatoria' => $convocatoria->getId(),
    'id' => $object->getId(),
)) ?>">
<?php if ($information): ?>
    <p><label>Nombre completo:</label><?php echo $object->getFullname() ?></p>
    <p><label>Carnet de identidad:</label><?php echo $object->getCi() ?></p>
    <p><label>Correo electrónico:</label><?php echo $object->getCorreoElectronico() ?></p>
<?php endif; ?>
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
