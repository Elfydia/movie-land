<?php

class ErrorService{
    public function __construct()
    {

    }

    public function logError(
            $errno,
            $errstr,
            $errfile,
            $errline
        ) {
            $error = "Date: " . date("d-m-Y H:i:s") . "\n";
            $error .= "Type d'erreur: $errno\n";
            $error .= "Message d'erreur: $errstr\n";
            $error .= "Fichier: $errfile\n";
            $error .= "Line: $errline\n\n";
            $filename = __DIR__ . "/../../log/" . date("d-m-Y") . "error.log";

            $fp = fopen($filename, "a+");
            fwrite($fp, $error);
            fclose($fp);

            // Logger l'erreur dans un endroit normé
            // Peut être un fichier par jour
            // Peut être une analyse à faire des niveau
            // Standard: https://www.php-fig.org/psr/psr-3/

        }

    public function fatalError($error=null

    ){
        if ($error || $error = error_get_last()) {
            var_dump($error);
            $this->logError(
                $error['type'],
                $error['message'],
                $error['file'],
                $error['line']
            );
        }
    }


}