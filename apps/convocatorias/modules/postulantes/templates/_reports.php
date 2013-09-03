<h1>Reportes</h1>

<p>En esta página usted puede seleccionar los campos y los filtros que usted
requiera para su reporte.</p>

<?php echo form_tag(
    url_for('postulantes_report',
    array('convocatoria' => $convocatoria->getId()))) ?>
    <p><label>Orientación del papel:</label>
        <select name="orientation">
            <option value="L">Paisaje</option>
            <option value="P">Retrato</option>
        </select>
    </p>
    <p><label>Selección de columnas:</label></p>
    <table class="form-table">
    <?php foreach ($columns as $key => $column): ?>
        <tr>
            <td style="width: 10px;">
                <input type="checkbox"
                       name="columns[]" value="<?php echo $key ?>" />
            </td>
            <td><?php echo $column ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <p><label>Selección de filtros:</label></p>
    <table class="form-table">
    <?php foreach ($filters as $key => $column): ?>
        <tr>
            <td style="width: 10px;">
                <input type="checkbox"
                       name="columns[]" value="<?php echo $key ?>" />
            </td>
            <td><?php echo $column ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <p class="submit"><input type="submit" value="Generar"></p>
</form>
