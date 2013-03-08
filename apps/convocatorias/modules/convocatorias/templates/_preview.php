<?php

$xml_file = realpath(dirname(__FILE__) . '/../../../../../data/xml/convocatorias/' . $convocatoria->getId() . '.xml');
$tpl = file_get_contents($xml_file);

// preproceso el archivo para generar los foreach
$parts = preg_split('/(\[\[ | \]\])/', $tpl);

$foreach_flag = false;
$foreach_start = -1;
$foreach_collection = null;
$foreach_components = array();

for ($i = 1; $i < count($parts); $i+=2) {
    $tag = $parts[$i];

    if (preg_match('/foreach [a-z]/', $tag)) {
        $element = substr($tag, 8);

        $foreach_flag = true;
        $foreach_start = $i;
        $foreach_collection = getProperty($convocatoria, $element);
        $foreach_components = array();

        $parts[$i] = '';
    } else if (preg_match('/endforeach/', $tag)) {
        $resume = array();

        $transpose = transponer($foreach_components);

        for ($j = 0; $j < count($transpose); $j++) {
            $res = '';
            for ($k = 0; $k < count($transpose[$j]); $k++) {
                $res .= $parts[$foreach_start + (2 * $k) + 1] . $transpose[$j][$k];
            }
            $res .= $parts[$i - 1];
            $resume[] = $res;
        }
        
        for ($c = $foreach_start; $c < $i; $c++) {
            $parts[$c] = '';
        }

        $parts[$i] = implode('', $resume);

        $foreach_flag = false;
        $foreach_start = -1;
        $foreach_collection = null;
        $foreach_components = array();
    } else {
        if ($foreach_flag) {
            $props = array();
            foreach ($foreach_collection as $element) {
                $props[] = getProperty($element, $tag);
            }
            $foreach_components[] = $props;
            $parts[$i] = '';
        } else {
            $parts[$i] = getProperty($convocatoria, $tag);
        }
    }
}

function transponer($matriz) {
    $transpuesta = array();
    for ($i = 0; $i < count($matriz); $i++) {
        for ($j = 0; $j < count($matriz[$i]); $j++) {
            $transpuesta[$j][$i] = $matriz[$i][$j];
        }
    }
    return $transpuesta;
}

function getProperty($object, $property) {
    $components = explode('.', $property);

    $iterator = $object;
    foreach ($components as $component) {
        $method = 'get' . ucfirst($component);
        $iterator = $iterator->$method();
    }

    return $iterator;
}

echo implode('', $parts);
