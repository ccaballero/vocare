<?php

class Xslt
{
    private $types_transform = array(
        'txt'   => 'text/plain; charset=utf-8',
        'latex' => 'text/plain; charset=utf-8',
        'pdf'   => 'application/pdf',
    );
    private $xslt_file;
    private $dir_generation;
    private $dir_xslt;

    private $output = '';

    public function __construct($xslt_file) {
        $this->dir_generation = sfConfig::get('app_dir_generation');
        $this->dir_xslt = sfConfig::get('app_xslt_transforms');
        $this->setXsltFile($xslt_file);
    }

    public function setXsltFile($xslt_file) {
        if (!file_exists($xslt_file)) {
            $xslt_file = $this->dir_xslt . '/' . $xslt_file;
            if (!file_exists($xslt_file)) {
                $xslt_file .= '.xslt';
                if (!file_exists($xslt_file)) {
                    return;
                }
            }
        }
        $this->xslt_file = $xslt_file;
        $this->output = '';
    }

    public function compile($xml) {
        $xslDoc = new DOMDocument();
        $xslDoc->load($this->xslt_file);

        $xmlDoc = new DOMDocument();
        $xmlDoc->loadXML(str_replace('&nbsp;', '', $xml));

        $proc = new XSLTProcessor();
        $proc->importStylesheet($xslDoc);

        try {
            ob_start();
            $proc->transformToURI($xmlDoc, 'php://output');
            $this->output = ob_get_contents();
            ob_clean();

            return $this->output;
        } catch (Exception $e) {
            $e->printStackTrace();
        }
    }

    public static function render($xslt, $xml) {
        $compile = new Xslt($xslt);
        return $compile->compile($xml);
    }

    public static function save($xslt, $xml, $filename) {
        $render = Xslt::render($xslt, $xml);
        $dir_generation = sfConfig::get('app_dir_generation');
        $file_generate = $dir_generation . '/' . $filename;
        return file_put_contents($file_generate, $render);
    }
}
