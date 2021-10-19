<?php

namespace model;

class EntityRepository
{
    private $db;    
    public $table; 

    
    public function getDb()
    {
        
        if(!$this->db)
        {

            try
            {
                $xml = simplexml_load_file('app/config.xml');
                $this->table = $xml->table; 

                try
                {
                    $this->db = new \PDO("mysql:host=" . $xml->host . ";dbname=" . $xml->db, $xml->user, $xml->password, array
                    (\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
                }
                catch(\PDOException $e) 
                {
                    echo "Erreur durant la création l'objet PDO : " . $e->getMessage();
                }
            }
            catch(\Exception $e) 
            {
                echo "Erreur dans la méthode getDB() : " . $e->getMessage();
            }
        }
        return $this->db;
    }

    public function selectAllEntityRepo()
    {
        $data = $this->getDb()->query("SELECT * FROM " . $this->table);
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }

    
    public function getFields()
    {
        $data = $this->getDb()->query("DESC " . $this->table);
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }

    public function searchEntityRepo($prenom)
    {
        $data = $this->getDb()->query("SELECT * FROM " . $this->table . " WHERE prenom_" . $this->table . " = " . $prenom);
        $r = $data->fetch(\PDO::FETCH_ASSOC);
        return $r;
    }
    
    public function selectEntityRepo($id)
    {
        $data = $this->getDb()->query("SELECT * FROM " . $this->table . " WHERE id_" . $this->table . " = " . $id);
        $r = $data->fetch(\PDO::FETCH_ASSOC);
        return $r;
    }

    public function updateEntityRepo($id)
    {
        $data = $this->getDb()->query("UPDATE * FROM " . $this->table . " WHERE id_" . $this->table . " = " . $id);
    }

    public function deleteEntityRepo($id)
    {
        $data = $this->getDb()->query("DELETE FROM " . $this->table . " WHERE id_" . $this->table . " = " . $id);
    }

}