<?php

namespace App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AutoloaderTwig
{
    private $loader;
    protected $twig;

    public function __construct()
    {
        // on paramètre le dossier contenant nos templates
        $this->loader = new FilesystemLoader('Views');

        // on parametre l'environnement twig
        $this->twig = new Environment($this->loader);


    }

}