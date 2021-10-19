<?php

namespace controller;

class Controller
{

    private $dbEntityRepository;

    public function __construct()
    {
        $this->dbEntityRepository = new \model\EntityRepository;
    }

    public function handleRequest()
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL;
        try
        {
            if($op == 'add'|| $op == 'update')
                $this->save();
            elseif($op == 'search')
                $this->search();
            elseif($op == 'select')
                $this->select();
            elseif($op == 'delete') 
                $this->delete();
            else                    
                $this->selectAll();
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function render($layout, $template, $parameters = array())
    {
        extract($parameters);

        ob_start();

        require "view/$template";

        $content = ob_get_clean();

        ob_start();
        require "view/$layout";

        return ob_end_flush();
    }

    public function search()
    {
        $prenom = isset($_GET['nom']) ? $_GET['nom'] : NULL;
        var_dump($prenom);

        $this->render('layout.php', 'affichage-employes.php', [
            'data' => $this->dbEntityRepository->selectAllEntityRepo($prenom),
            'fields' => $this->dbEntityRepository->getFields(),
            'prenom' => 'prenom_' . $this->dbEntityRepository->table
        ]);
    }

    public function selectAll()
    {
        $this->render('layout.php', 'affichage-employes.php', [
            'title' => 'Affichage de tous les employés', 
            'data' => $this->dbEntityRepository->selectAllEntityRepo(),
            'fields' => $this->dbEntityRepository->getFields(),
            'id' => 'id_' . $this->dbEntityRepository->table
        ]);
    }

    public function select()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        var_dump($id);

        $this->render('layout.php', 'detail-employe.php', [
            'title' => "Détail de l'employé n°$id",
            'data' => $this->dbEntityRepository->selectAllEntityRepo($id),
            'fields' => $this->dbEntityRepository->getFields(),
            'id' => 'id_' . $this->dbEntityRepository->table
        ]);
    }

    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        var_dump($id);

        $this->dbEntityRepository->deleteEntityRepo($id);

        $this->render('layout.php', 'affichage-employes.php', [
            'title' => "Employé n°$id supprimé",
            'data' => $this->dbEntityRepository->selectAllEntityRepo($id),
            'fields' => $this->dbEntityRepository->getFields()
        ]);
    }
}