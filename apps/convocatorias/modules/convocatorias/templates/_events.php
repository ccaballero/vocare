<p>En esta página puede usted establecer el conjunto de acciones automaticas a
realizarse bajo los cambios de fechas en los eventos que usted definió para su
convocatoria.</p>

<div class="clone" style="display: none;">
    <div class="tasks">
        <?php echo task_selector($tasks, null,
            'tasks[][]') ?>
    </div>
</div>

<?php echo form_tag(
    url_for('convocatorias_eventos',
    array('id' => $object->getId()))) ?>

    <table>
        <thead>
            <tr class="header">
                <th>Evento</th>
                <th>Fecha</th>
                <th>Tareas</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($events as $i => $event): ?>
            <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
                <td>
                    <span><?php echo $event->getEvento()->getNombre() ?></span>
                    <br />
                    <?php echo $event->getEvento()->getDescripcion() ?>
                </td>
                <td class="text-center">
                    <?php echo pretty_date($event->getFecha()) ?>
                </td>
                <td>
                    <ul class="list">
                    <?php foreach (explode('::', $event->tasks) as $task): ?>
                        <li><?php echo task_selector($tasks, $task,
                            'tasks[' . $task . '][]') ?></li>
                    <?php endforeach; ?>
                    </ul>
                    <a onclick="return add_li(this,'.clone div.tasks');">
                        Agregar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <p class="submit">
        <input type="submit" value="Registrar">
    </p>
</form>
