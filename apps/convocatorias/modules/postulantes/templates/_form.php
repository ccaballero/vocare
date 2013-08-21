<p>Este formulario tiene por objetivo manifestar la intención de usted -señor
usuario del sitio- a querer participar del proceso que implica esta
convocatoria. Lo primero que le sugerimos desde acá, es que revise los
requisitos necesarios y asegurese que los cumple a cabalidad.</p>

<p>Si todavia se encuentra animado a postular, el primer paso de su nuevo
ascenso al exito es rellenar este formulario con su información personal, y una
confirmación de registro será enviada a su correo electronico.</p>

<p>Recuerda que en caso de encontrar algun problema, siempre puede acudir al
departamento de informática-sistemas.</p>

<?php echo form_tag(
    url_for('convocatorias_postular',
    array('id' => $object->getId()))) ?>
    <?php echo $form ?>
    <p class="submit">
        <input type="submit"
            value="<?php echo $form->isNew() ? 'Postular' : 'Modificar'?>" />
    </p>
</form>
