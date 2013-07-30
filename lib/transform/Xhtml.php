<?php

class Xhtml
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
        $parts = preg_split('/(\[\[ | \]\])/', $this->template);
        $root = new StdClass();

        $components = array($root);
        $last_component = $root;

        for ($i = 1; $i < count($parts); $i+=2) {
            $tag = $parts[$i];

            if (preg_match('/foreach [a-z]/', $tag)) {
                $element = substr($tag, 8);
                $new_component = new StdClass();
                $components[] = $new_component;
                $last_component->$element = $new_component;
                $last_component = $new_component;
            } else if (preg_match('/endforeach/', $tag)) {
                array_pop($components);
                $last_component = end($components);
            } else {
                $last_component->$tag = '';
            }
        }

        return $root;
    }

    public function compile() {
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
                $foreach_collection = $this->getProperty(
                    $this->object, $element);
                $foreach_components = array();

                $parts[$i] = '';
            } else if (preg_match('/endforeach/', $tag)) {
                $resume = array();

                $transpose = $this->transponer($foreach_components);

                for ($j = 0; $j < count($transpose); $j++) {
                    $res = '';
                    for ($k = 0; $k < count($transpose[$j]); $k++) {
                        $res .= $parts[$foreach_start + (2 * $k) + 1]
                             . $transpose[$j][$k];
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
            try {
                $iterator = $iterator->$component;
            } catch (Exception $e1) {
                try {
                    $iterator = $iterator->$method();
                } catch (Exception $e2) {
                }
            }
        }

        return $iterator;
    }

    public static function render($text, $vars, $scape = false) {
        $compile = '';
        $tpl = new Xhtml();
        $specialEscape = new SpecialEscape();

        if (!empty($text)) {
            $tpl->setTemplate($text);
            $tpl->setObject($vars);

            $compile = $tpl->compile();
            if ($scape) {
                $compile = $specialEscape->specialEscape($compile);
            }
        }

        return $compile;
    }

    public static function save($text, $vars, $scape, $destination) {
        $render = Xhtml::render($text, $vars, $scape);
        $content = '<vocare>' . $render . '</vocare>';

        return file_put_contents($destination, $content);
    }

    public static function taxonomy($text) {
        $tpl = new Xhtml();
        $tpl->setTemplate($text);
        return $tpl->getTaxonomy();
    }
}
