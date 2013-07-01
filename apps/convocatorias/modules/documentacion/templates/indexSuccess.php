<h1>Gestión de documentación</h1>
<p>Aqui se encuentran concentradas las funciones necesarias para la generación
automatica de grandes volumenes de documentación. Se requiere entender dos
conceptos para manejar satisfactoriamente esta sección del sistema:</p>
<dl>
    <dt><strong>Plantilla de documentación</strong></dt>
    <dd>
        <p>Es un documento patrón, sobre el que pueden establecerse un conjunto
        de partes que son cambiantes, pero que comparten el mismo diseño,
        patrones, estilos, y contenido estatico.</p>
    </dd>
    <dt><strong>Volumen de documentación</strong></dt>
    <dd>
        <p>Se refiere al conjunto de documentos que usan una misma plantilla
        pero que definen concretamente aquellas partes dinamicas de la
        plantilla.</p>
        <p>Una vez usted crea un volumen de documentación, puede definir los
        documentos concretos que usted necesite.</p>
    </dd>
</dl>

<h2>Volumenes de documentación</h2>
<div class="tasks">
    <ul>
    <?php if ($sf_user->hasCredential('documentacion_create')): ?>
        <li><?php echo link_to('Crear nuevo volumen de documentación',
            url_for('documentacion_new'), array('accesskey' => 'n')
        ) ?></li>
    <?php if ($sf_user->hasCredential('documentacion_plantilla_list')): ?>
    <?php endif; ?>
        <li><?php echo link_to('Plantillas de documentación',
            url_for('plantillas'), array('accesskey' => 'p')
        ) ?></li>
    <?php endif; ?>
    </ul>
</div>

<table>
    <tr class="header">
        <th>Nombre</th>
        <th>&nbsp;</th>
    </tr>
<?php if (count($list) != 0): ?>
<?php foreach ($list as $i => $documento): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $documento->getNombre() ?></td>
        <td>
            <ul>
            <?php if ($sf_user->hasCredential('documentacion_view')): ?>
                <li><?php echo link_to(
                    'Examinar', 'documentacion_show', $documento
                ) ?></li>
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('documentacion_delete')): ?>
                <li><?php echo link_to(
                    'Eliminar', 'documentacion_delete', $documento,
                    array(
                        'method' => 'delete',
                        'confirm' => '¿Esta seguro que desea eliminar '
                            . 'el documento?',
                    )
                ) ?></li>
            <?php endif; ?>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
<?php else: ?>
    <tr>
        <td>
            <p>No se encontraron documentos generados.</p>
        </td>
    </tr>
<?php endif; ?>
</table>
