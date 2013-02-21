<h1>Plantillas de documentos requisitos</h1>

<div class="tasks"><?php echo link_to(
    'Crear nuevo documento requisito', url_for('documentos_new')
) ?></div>

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
                <li><?php echo link_to(
                    'Editar', 'documentos_edit', $documento
                ) ?></li>
                <li><?php echo link_to(
                    'Eliminar', 'documentos_delete', $documento, array(
                        'method' => 'delete',
                        'confirm' => '¿Esta seguro que desea eliminar el documento?'
                    )
                ) ?></li>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
</table>
