<br />

<p>Este formulario tiene por objetivo manifestar la intención de usted usuario
del sitio, a querer participar del proceso que implica esta convocatoria, lo
primero que le sugerimos desde acá, es que revise los requisitos necesarios, y
las implicaciones de compromiso que conllevan tal postulación.</p>

<p>Si todavia se encuentra animado a postular, el primer paso ha realizar es
completar el siguiente formulario:</p>

<form method="post" action="">
    <?php echo $form ?>
    <p class="submit">
        <input type="submit"
            value="<?php echo $form->isNew() ? 'Postular' : 'Modificar'?>" />
    </p>
</form>
