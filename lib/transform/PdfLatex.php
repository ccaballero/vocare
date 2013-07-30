<?php

class PdfLatex
{
    public static function compile($filename) {
        $dir_generation = sfConfig::get('app_dir_generation');

        $tex_file = $dir_generation . $filename . '.tex';
        $pdf_file = $dir_generation . $filename . '.pdf';
        $dir_file = dirname($pdf_file);

        $pdflatex = sfConfig::get('app_pdflatex');
        exec("$pdflatex -output-directory $dir_file $tex_file");

        if (file_exists($pdf_file)) {
            return $pdf_file;
        } else {
            return false;
        }
    }
}
