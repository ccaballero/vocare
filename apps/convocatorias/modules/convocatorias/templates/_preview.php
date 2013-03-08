<?php

$xml_file = realpath(dirname(__FILE__) . '/../../../../../data/xml/convocatorias/' . $convocatoria->getId() . '.xml');
$tpl = file_get_contents($xml_file);

// preproceso el archivo para generar los foreach
$parts = preg_split('/(\[\[ | \]\])/', $tpl);

$foreach_flag = false;
$foreach_collection = null;
$foreach_components = array();

for ($i = 1; $i < count($parts); $i+=2) {
    $tag = $parts[$i];

    if (preg_match('/foreach [a-z]/', $tag)) {
        $element = substr($tag, 8);
        $foreach_flag = true;

        $method = 'get' . ucfirst($element);
        $foreach_collection = $convocatoria->$method();

        $parts[$i] = '';
    } else if (preg_match('/endforeach/', $tag)) {
        $foreach_flag = false;
        $foreach_collection = null;

        $parts[$i] = '';
    } else {
        if ($foreach_flag) {
            foreach ($foreach_collection as $element) {
                $method = 'get' . ucfirst($tag);
                $foreach_components[] = $element->$method();
            }

            $parts[$i] = '';
        } else {
            $method = 'get' . ucfirst($tag);
            $parts[$i] = $convocatoria->$method();
        }
    }
}

echo implode('', $parts);
