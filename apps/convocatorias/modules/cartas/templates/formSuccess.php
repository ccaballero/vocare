<h1><?php echo $title ?></h1>

<?php echo form_tag_for($form, '@cartas') ?>
    <?php echo $form ?>
    <p class="submit">
        <input type="submit" value="Registrar" />&nbsp;
        <?php echo link_to('Volver a la lista', url_for('cartas')) ?>
    </p>
</form>
