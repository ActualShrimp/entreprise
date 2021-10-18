<?php

class Autoload
{
    //                                    controller\Controller
    public static function inclusionAuto($className)
    {

        // str_replace() : fonction prédéfinie qui permet ici de remplacer les '\' par des '/' afin de définir le bon chemin

        // require_once "C:\xampp\htdocs\phpoo\11-CRUD" . \controller\Controller.php
        require_once __DIR__ . '/' . str_replace('\\', '/', $className . '.php');
        // AFFICHAGE du bon chemin sur la page web pour controle
        // echo __DIR__ . '/' . str_replace('\\', '/', $className . '.php');


    }
}


spl_autoload_register(array('Autoload', 'inclusionAuto'));


/*
    spl_autoload_register() : fonction prédéfinie qui s'execute lorsque l'interpréteur voit passer le mot clé "new"
    Lorsque l'on instancie une classe, la fonction 'inclusionAuto' de la classe 'Autoload' s'execute automatiquement et tout ce qu'il y a après
    on se sert du 'namespace' 'controller' pour entrer dans le dossier controller du dossier '11-CRUD' et du nom de la classe 'Controller' pour inclure le fichier Controller.php
    Il faut bien respecter une convention de nommage pour les dossiers et les fichiers
*/

// $c = new controller\Controller;