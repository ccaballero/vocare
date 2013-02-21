<h1><?php echo $object->getCodigo() ?></h1>
<span style=""><?php echo $object->getHorasAcademicas() ?></p>
<p><?php echo $object->getNombre() ?></p>
<br />
[<?php echo link_to('Volver a la lista', url_for('requerimientos')) ?>]