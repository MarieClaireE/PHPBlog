<?php
namespace App\Model;

use App\Core\Cnx;

class Model extends Cnx 
{
    // table de la bdd
    protected $table;

    // instance de dbb;
    private $db;

    // CRUD
    public function findAll() 
    {
        $req = $this->requete('SELECT * FROM '. $this->table);
        return $req->fetchAll();
    }

    public function findBy(array $criteres)
    {
        $keys = [];
        $values = [];

        //on boucle pour éclater le tableau
        foreach ($criteres as $key => $value) {
            // SELECT * FROM tables WHERE type = ?
            // bindValue(1, valeur)
            $keys[] = "$key = ?";
            $values[] = $value;
        }
        // on transforme le tableau keys en chaine de caractères
        $listsKeys = implode(' AND ', $keys);
        
        // on execute la requete
        return $this->requete('SELECT * FROM '.$this->table.' WHERE '. $listsKeys, $values)->fetchAll();
    }

    public function find(int $id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE id = $id")->fetch();
    }

    public function create(Model $model)
    {
        $keys = [];
        $points = [];
        $values = [];

        //on boucle pour éclater le tableau
        foreach ($model as $key => $value) {
            // INSERT INTO table () VALUES ();
            if ($value != null && $key != 'db' && $key != 'table') {
                $keys[] = $key;
                $points[] = "?";
                $values[] = $value;
            }
        }
        // on transforme le tableau keys en chaine de caractères
        $listsKeys = implode(', ', $keys);
        $listPoints = implode(',', $points);
        
        // on execute la requete
        return $this->requete('INSERT INTO '.$this->table.' ('. $listsKeys .') VALUES ('.$listPoints.')', $values);
    }

    // rentre les données trouvé dans un tableau exemple POST formulaire
    public function hydrate(array $datas) {
        foreach ($datas as $key => $value) {
            // on récupère le nom du setter correspondant à la clé 
            //titre->setTitre()
            $setter = 'set'.ucfirst($key);

            // on vérifie si le setter existe
            if (method_exists($this, $setter)) {
                // on appelle le setter
                $this->$setter($value);
            }
        }
        return $this;
    }

    public function update (int $id, Model $model) {
        $keys = [];
        $values = [];

        //on boucle pour éclater le tableau
        foreach ($model as $key => $value) {
            // UPADTE table SET key = ? WHERE id = ?;
            if ($value != null && $key != 'db' && $key != 'table') {
                $keys[] = "$key = ?" ;
                $values[] = $value;
            }
        }
        $values[] = $id;

        // on transforme le tableau keys en chaine de caractères
        $listsKeys = implode(', ', $keys);
        
        // on execute la requete
        return $this->requete('UDPATE '. $this->table. ' SET  '. $listsKeys .' WHERE id = ?', $values);
    }

    public function delete(int $id)
    {
        return $this->requete("DELETE FROM $this->table WHERE id=?", [$id]);
    }

    public function requete(string $sql, array $attributs = null)
    {
        // on récupère un instance de bdd
        $this->cnx = Cnx::getInstance();

        // on vérifie si on a des attributs
        if($attributs !== null) {
            // requêtes préparées
            $req = $this->cnx->prepare($sql);
            $req->execute($attributs);
            return $req;
        } else {
            // requêtes simples
            return $this->cnx->query($sql);
        }
    }
    
}