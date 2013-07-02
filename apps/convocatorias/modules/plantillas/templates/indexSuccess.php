<h1>Plantillas de documentación</h1>
<p>En este lugar usted puede crear y administrar las plantillas que necesite
para la generación automatica de documentación. Recuerde que estas plantillas
pueden ser utilizadas en muchas partes del sistema, aunque la sintaxis de las
plantillas pudiese parecer complicada, recuerde que es el precio a pagar por la
potencia que se gana a la hora de automatizar.</p>

<?php if ($sf_user->hasCredential('documentacion_plantilla_create')): ?>
<div class="tasks">
    <ul>
        <li><?php echo link_to('Crear nueva plantilla de documentación',
            url_for('plantillas_new'), array('accesskey' => 'n')
        ) ?></li>
        <li><?php echo link_to('Volver a la lista de volumenes',
            url_for('documentacion')
        ) ?></li>
    </ul>
</div>
<?php endif; ?>

<table>
    <tr class="header">
        <th>Nombre</th>
        <th>&nbsp;</th>
    </tr>
<?php foreach ($list as $i => $plantilla): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $plantilla->getNombre() ?></td>
        <td>
            <ul>
        <?php if ($sf_user->hasCredential('documentacion_plantilla_view')): ?>
                <li><?php echo link_to(
                    'Ver', 'plantillas_show', $plantilla
                ) ?></li>
            <?php endif; ?>
        <?php if ($sf_user->hasCredential('documentacion_plantilla_edit')): ?>
                <li><?php echo link_to(
                    'Editar', 'plantillas_edit', $plantilla
                ) ?></li>
            <?php endif; ?>
        <?php if ($sf_user->hasCredential('documentacion_plantilla_create')): ?>
                <li><?php echo link_to(
                    'Duplicar', 'plantillas_clonar', $plantilla,
                    array(
                        'method' => 'post',
                        'confirm' => '¿Esta seguro que desea duplicar '
                            . 'esta plantilla de documentación?',
                    )
                ) ?></li>
            <?php endif; ?>
        <?php if ($sf_user->hasCredential('documentacion_plantilla_delete')): ?>
                <li><?php echo link_to(
                    'Eliminar', 'plantillas_delete', $plantilla,
                    array(
                        'method' => 'delete',
                        'confirm' => '¿Esta seguro que desea eliminar '
                            . 'la plantilla de documentación?',
                    )
                ) ?></li>
            <?php endif; ?>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
</table>
