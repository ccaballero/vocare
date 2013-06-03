<?php if ($form->isNew()): ?>
<h1>Nueva convocatoria</h1>
<?php else: ?>
<h1>Editar convocatoria</h1>
<?php endif; ?>

<?php echo form_tag_for($form, '@convocatorias') ?>
    <?php echo $form ?>
    <p class="submit">
        <input type="submit"
            value="<?php echo $form->isNew() ? 'Registrar' : 'Modificar'?>" />
        &nbsp;<?php echo link_to('Volver a la lista', url_for('convocatorias')) ?>
    </p>
</form>
