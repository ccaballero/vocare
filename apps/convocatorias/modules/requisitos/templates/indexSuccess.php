<h1>Plantillas de requisitos</h1>

<div class="tasks"><?php echo link_to(
    'Crear nuevo requisito', url_for('requisitos_new')
) ?></div>

<table>
    <tr class="header">
        <th>Requisito</th>
        <th>&nbsp;</th>
    </tr>
<?php foreach($list as $i => $requisito): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $requisito->getTexto() ?></td>
        <td>
            <ul>
                <li><?php echo link_to(
                    'Editar', 'requisitos_edit', $requisito
                ) ?></li>
                <li><?php echo link_to(
                    'Eliminar', 'requisitos_delete', $requisito, array(
                        'method' => 'delete',
                        'confirm' => '¿Esta seguro que desea eliminar el requisito?'
                    )
                ) ?></li>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
</table>
