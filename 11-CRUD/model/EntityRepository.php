<?php

namespace model;

class EntityRepository
{
    private $db;    // permet de stocker un objet issu de la classe PDO, c'est à dire la connexion à la BDD 
    public $table;  // permet de stocker le nom de la table SQL afin de l'injecter dans les différentes requetes SQL

    // fonction permettant de construire la connexion à la BDD
    public function getDb()
    {
        // Si dans la variable $db, il n'y a pas de connexion PDO, alors on entre dans le IF et on construit la connexion
        if(!$this->db)
        {

            try
            {

                // simplexml_load_file() : fonction PHP qui permet de charger un fichier XML et de retourner un objet PHP SimpleXMLElement contenant toutes les informations de la connexion à la BDD
                $xml = simplexml_load_file('app/config.xml');
                // echo '<pre>'; print_r($xml); echo '</pre>';

                $this->table = $xml->table; // on affecte le nomm de la table SQL récupéré via le fichier XML à la propriété $table de la classe EntityRepository

                try // On tente d'executer la connexion à la BDD
                {

                    // Nous n'écrivons pas en dur les coordonnées de la BDD, on injecte directement les données du fichier XML, qui contient les coordonnées de la BDD
                    // On affecte à la propriété privé $db la connexion à la BDD (PDO)
                    $this->db = new \PDO("mysql:host=" . $xml->host . ";dbname=" . $xml->db, $xml->user, $xml->password, array
                    (\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));

                    // echo '<pre>'; var_dump($this->db); echo '</pre>';

                }
                catch(\PDOException $e) // le bloc catch permet d'attraper les PDOException levé durant la tentative de connexion à la BDD
                {
                    echo "Erreur durant la création l'objet PDO : " . $e->getMessage();
                }



            }
            catch(\Exception $e) // le bloc catch permet d'attraper les Exception levé durant la tentative de connexion
            {
                echo "Erreur dans la méthode getDB() : " . $e->getMessage();
            }


        }
        // Si la propriété $db contient bien une connexion BDD, un objet PDO, on retourne la connexion
        return $this->db;
    }

    public function selectAllEntityRepo()
    {
        // $pdo      $pdo->query('SELECT * FROM employes')
        $data = $this->getDb()->query("SELECT * FROM " . $this->table);
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }

    // Méthode permettant de sélectionner tout les noms des champs de la table 'employes'.
    public function getFields()
    {
        $data = $this->getDb()->query("DESC " . $this->table);
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }


    // Méthode permettant de sélectionner un employé dans la BDD en fonction de son ID
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

// TEST
// $e = new EntityRepository;
// $e->getDb();
// echo '<pre>'; print_r($e); echo '</pre>';
// echo '<pre>'; print_r(get_class_methods($e)); echo '</pre>';