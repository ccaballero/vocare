<?php

$xml_file = realpath(dirname(__FILE__) . '/../../../../../data/xml/convocatorias/' . $convocatoria->getId() . '.xml');
$tpl = file_get_contents($xml_file);

// preproceso el archivo para generar los foreach
$parts = preg_split('/\[\[ (?P<name>.*) \]\]/', $tpl, -1, PREG_SPLIT_NO_EMPTY);


//[[ foreach asdf ]]

//$variables_list = array();
//preg_match_all('/\[\[.*\]\]/', $tpl, $variables_list);

//[[ endforeach ]]

echo '<pre>';
var_dump($parts);
echo '</pre>';

//$this->tpl = preg_replace('/\[\[(.*)\]\]/', '<span class="highlight">[[$1]]</span>', $tpl);
