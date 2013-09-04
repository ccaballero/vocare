<h1>Reportes</h1>

<p>En esta página usted puede seleccionar los campos y los filtros que usted
requiera para su reporte.</p>

<p>Para la utilización de filtros, recuerde que si marca varios del mismo tipo
estos estarán conectados por una relación disyuntiva (ALGO O ALGO MAS). En
cambio si marca varios de diferentes categorias, estos se agregarán en modo
conjuntivo (ALGO Y ALGO MAS). Lo mas probable es que probando la generación,
usted señor usuario entienda mejor, que solo leyendo mis explicaciones.</p>

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
            <td>
                <?php echo $column ?><br/>
                <?php echo filters(
                    $key, 'filters[' . $key . '][]', $convocatoria) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <p class="submit"><input type="submit" value="Generar"></p>
</form>
