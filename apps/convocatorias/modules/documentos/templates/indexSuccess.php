<h1>Plantillas de documentos requisitos</h1>

<?php if ($sf_user->hasCredential('plantillas_create')): ?>
<div class="tasks">
    <ul>
        <li><?php echo link_to('Crear nuevo documento requisito',
            url_for('documentos_new'), array('accesskey' => 'n')
        ) ?></li>
        <li><?php echo link_to('Administración de plantillas',
            url_for('portada/plantillas'), array('accesskey' => 'p')
        ) ?></li>
    </ul>
</div>
<?php endif; ?>

<table>
    <tr class="header">
        <th>Documento requisito</th>
        <th>&nbsp;</th>
    </tr>
<?php foreach($list as $i => $documento): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $documento->getTexto() ?></td>
        <td>
            <ul>
            <?php if ($sf_user->hasCredential('plantillas_edit')): ?>
                <li><?php echo link_to(
                    'Editar', 'documentos_edit', $documento
                ) ?></li>
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('plantillas_delete')): ?>
                <li><?php echo link_to(
                    'Eliminar', 'documentos_delete', $documento, array(
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
</table>
