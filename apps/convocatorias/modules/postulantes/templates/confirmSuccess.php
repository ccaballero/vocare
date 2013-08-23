<h1>Confirmación de postulación</h1>

<p>Felicitaciones, tu acabas de confirmar tu intención de participar del proceso
de seleccion en la convocatoria <?php echo $convocatoria->getGestion() ?>.</p>

<p>A continuación te mostramos la información que tenemos acerca de ti, te
sugerimos que la revises minuciosamente y procures que no exista ningun error.
En caso de que hayas descubierto algo incorrecto, te sugerimos, que vayas al
departamento de informatica-sistemas, para solucionar el asunto lo antes
posible.</p>

<form>
<p><label>Apellido Paterno:</label>
   <?php echo $postulante->getApellidoPaterno() ?></p>
<p><label>Apellido Materno:</label>
   <?php echo $postulante->getApellidoMaterno() ?></p>
<p><label>Nombres:</label>
   <?php echo $postulante->getNombres() ?></p>
<p><label>Carnet de Identidad:</label>
   <?php echo $postulante->getCi() ?></p>
<p><label>Código SIS:</label>
   <?php echo $postulante->getSis() ?></p>
<p><label>Correo electrónico:</label>
   <?php echo $postulante->getCorreoElectronico() ?></p>
<p><label>Telefonos de contacto:</label>
   <?php echo $postulante->getTelefono() == '' ?
        'No especificado' : $postulante->getTelefono() ?></p>
<p><label>Dirección:</label>
   <?php echo $postulante->getDireccion() == '' ?
        'No especificado' : $postulante->getDireccion() ?></p>
<p><label>Ítems seleccionados:</label></p>
<ul class="form-table">
    <?php foreach ($postulante->getRequerimientos() as $requerimiento): ?>
        <li><?php echo $requerimiento ?></li>
    <?php endforeach; ?>
</ul>
</form>
