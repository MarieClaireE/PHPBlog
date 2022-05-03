<?php

namespace App;


class Autoload {

    static function register() {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class) {
        // on récupère dans $class la totalité du namespace de la classe concernée
        // On retire App\
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        
        // on remplace les \ par /
        $class = str_replace('\\', '/', $class);

        $fichiers = __DIR__ . '/' . $class . '.php';

        if (file_exists($fichiers)) {
            require_once $fichiers;
        }
    }
}