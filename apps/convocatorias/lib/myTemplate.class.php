<?php

class myTemplate
{
    private $template;
    private $object;
    private $renderization;

    public function setTemplateFile($filename) {
        $this->template = file_get_contents($filename);
    }

    public function setTemplate($template) {
        $this->template = $template;
    }

    public function setObject($object) {
        $this->object = $object;
    }

    public function getTaxonomy() {
        // preproceso el archivo para generar los foreach
        $parts = preg_split('/(\[\[ | \]\])/', $this->template);
        $structure = new StdClass();

        $foreach_flag = false;
        $foreach_element = '';
        $foreach_components = new StdClass();

        for ($i = 1; $i < count($parts); $i+=2) {
            $tag = $parts[$i];

            if (preg_match('/foreach [a-z]/', $tag)) {
                $foreach_flag = true;
                $foreach_element = substr($tag, 8);
                $foreach_components = new StdClass();
            } else if (preg_match('/endforeach/', $tag)) {
                $foreach_flag = false;
                $structure->$foreach_element = $foreach_components;
            } else {
                if ($foreach_flag) {
                    $foreach_components->$tag = '';
                } else {
                    $structure->$tag = '';
                }
            }
        }

        return $structure;
    }

    public function render() {
        // preproceso el archivo para generar los foreach
        $parts = preg_split('/(\[\[ | \]\])/', $this->template);

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
                $foreach_collection = $this->getProperty($this->object, $element);
                $foreach_components = array();

                $parts[$i] = '';
            } else if (preg_match('/endforeach/', $tag)) {
                $resume = array();

                $transpose = $this->transponer($foreach_components);

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
                        $props[] = $this->getProperty($element, $tag);
                    }
                    $foreach_components[] = $props;
                    $parts[$i] = '';
                } else {
                    $parts[$i] = $this->getProperty($this->object, $tag);
                }
            }
        }

        $this->renderization = implode('', $parts);
        return $this->renderization;
    }

    private function transponer($matriz) {
        $transpuesta = array();
        for ($i = 0; $i < count($matriz); $i++) {
            for ($j = 0; $j < count($matriz[$i]); $j++) {
                $transpuesta[$j][$i] = $matriz[$i][$j];
            }
        }
        return $transpuesta;
    }

    private function getProperty($object, $property) {
        $components = explode('.', $property);

        $iterator = $object;
        foreach ($components as $component) {
            $method = 'get' . ucfirst($component);
            if (method_exists($iterator, $method)) {
                $iterator = $iterator->$method();
            } else if (property_exists($iterator, $component)) {
                $iterator = $iterator->$component;
            }
        }

        return $iterator;
    }
}
