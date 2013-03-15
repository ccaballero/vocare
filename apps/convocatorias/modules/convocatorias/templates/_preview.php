<?php

$tpl = new myTemplate();
$tpl->setTemplateFile(
    realpath(dirname(__FILE__) .
    '/../../../../../data/xml/convocatorias/' .
    $convocatoria->getId() . '.xml'));
$tpl->setObject($convocatoria);

echo $tpl->render();
