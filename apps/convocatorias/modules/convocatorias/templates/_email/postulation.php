<?php $url_convocatoria = url_for(
    'convocatorias_show',
    array('id' => $convocatoria['id']), true) ?>
<?php $url_confirmation = url_for(
    'postulantes_confirm',
    array(
        'convocatoria' => $convocatoria->getId(),
        'id' => $postulante,
        'hash' => $hash,
    ), true) ?>

<p>Saludos...</p>
<p>Le ha llegado este correo electrónico, porque usted ha decidido postular para
el proceso de una convocatoria (<?php echo $convocatoria->getGestion() ?>), a mi
parecer existen dos opciones:</p>
<ol>
    <li>Usted verdadermente postuló en la página web:
        <a href="<?php echo $url_convocatoria ?>">
        <?php echo $url_convocatoria ?></a>, y todos estamos donde queremos
        estar.</li>
    <li>Le llego este correo electrónico, sin que usted hiciera nada para
        merecerlo.</li>
</ol>
<p>Si usted nunca quizo postularse a nada, o se arrepintió por razones
desconocidas, le recomendamos que no siga leyendo el resto, ya que sería una
perdida de valioso tiempo.</p>
<p>En caso de ser intención suya postularse, necesitamos que nos confirme tales
ganas. Simplemente necesitamos que siga el enlace que se encuentra mas abajo;
una vez confirmada su postulación, usted podrá ver su información personal,
ademas de algunas maneras en las que usted puede hacer el seguimiento del
proceso que implica esta convocatoria.</p>

<center>
    <a href="<?php echo $url_confirmation ?>">Click aqui para confirmar</a>
</center>
