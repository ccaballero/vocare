<h1>Preferencias de usuario</h1>

<p>En esta página usted puede reconfigurar sus datos personales.</p>

<form accept-charset="utf-8" action="" method="post">
    <?php echo $settings ?>
    <p class="submit">
        <input type="hidden" name="type" value="settings" />
        <input type="submit" value="Guardar preferencias" />
    </p>
</form>

<p>Este otro formulario sirve para que usted, si asi lo desea pueda cambiar su
contraseña para el acceso al sistema.</p>

<form accept-charset="utf-8" action="" method="post">
    <?php echo $passwd ?>
    <p class="submit">
        <input type="hidden" name="passwd" value="settings" />
        <input type="submit" value="Modificar contraseña" />
    </p>
</form>
