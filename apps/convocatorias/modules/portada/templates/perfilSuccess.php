<h1>Preferencias de usuario</h1>

<p>En esta página usted puede reconfigurar sus datos personales, asi como los
datos necesarios para el acceso al sistema.</p>

<?php echo form_tag_for($form, 'portada/perfil') ?>
    <?php echo $form ?>
    <p class="submit">
        <input type="submit" value="Guardar" />
    </p>
</form>
