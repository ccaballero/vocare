<html>
    <head></head>
    <body>
        <pre><?php

        define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/..'));

        $tex_file = APPLICATION_PATH . '/vocare/data/convocatorias/2_1.tex';
        $pdf_file = APPLICATION_PATH . '/vocare/data/convocatorias/2_1.pdf';
        $dir_file = dirname($pdf_file);

        echo 'Testing ..... ' . PHP_EOL;
        echo 'Latex file in ...... [' . $tex_file . ']' . PHP_EOL;
        echo 'PDF file in ...... [' . $pdf_file . ']' . PHP_EOL;

        if (file_exists($tex_file)) {
            echo 'El archivo fuente existe' . PHP_EOL;
        } else {
            echo 'El archivo fuente no existe' . PHP_EOL;
        }

        if (is_writable($dir_file)) {
            echo 'La carpeta es escribible' . PHP_EOL;
        } else {
            echo 'La carpeta no es escribible' . PHP_EOL;
        }

//        echo 'Comprobando paths' . PHP_EOL;
//        echo system('export') . PHP_EOL;
        
//        echo 'Verificando paquetes' . PHP_EOL;
//        echo system('ls -l /var/lib/texmf') . PHP_EOL;

//        echo system('cat /var/lib/texmf/ls-R') . PHP_EOL;
        
        echo str_repeat('-', 80) . PHP_EOL;
        echo 'Probando compilación' . str_repeat(PHP_EOL, 2);
        echo system("pdflatex -output-directory $dir_file $tex_file");

        ?></pre>
    </body>
</html>
