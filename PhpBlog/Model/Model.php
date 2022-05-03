<?php

namespace App\Model;

use App\Core\Cnx;

class Model extends Cnx
{
    protected $table;
    private $db;

  // CRUD
    //read All
    public function findAll()
    {
        $req = $this->requete('SELECT * FROM '. $this->table);
        return $req->fetchAll();
    }
    // read one by ..
    public function findBy(array $crits) {
        $keys = [];
        $values = [];

        // on boucle pour éclater le tableau 
        foreach ($crits as $key => $value)
        {
        $keys[] = "$key = ?";
        $values[] = $value;
        }
        // on transforme le tableau keys en chaine de caractères
        $listsKeys = implode(' AND ', $keys);

        // on execute la requete
        return $this->requete('SELECT * FROM '.$this->table.' WHERE '. $listsKeys, $values)->fetchAll();
    }

    // read one 
    public function find(int $id)
    {
        return $this->requete('SELECT * FROM '. $this->table .' WHERE id = '. $id)->fetch();
    }

    // create
    public function create(Model $model)
    {
        $keys=[];
        $points=[];
        $values=[];

        //on boucle pour éclater le bateau
        foreach ($model as $key => $value)
        {
            if ($value != null && $key != 'db' && $key != 'table')
            {
                $keys[] = $key;
                $points[] = "?";
                $values[] = $value;
            }
        }
        // on transforme le tableau keys et points en chaine de caractères
        $listsKeys = implode(', ', $keys);
        $listsPoints = implode(', ', $points);

        // on exécute la requête
        return $this->requete('INSERT INTO '.$this->table.' ('.$listsKeys .') VALUES ('.$listsPoints.')', $values);
    }

    // hydrate
    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value)
        {
            $setter = 'set'.ucfirst($key);
            if (method_exists($this, $setter))
            {
                $this->$setter($value);
            }
        }
        return $this;
    }

    // update
    public function update(int $id, Model $model) {
        $keys = [];
        $values = [];
        
        foreach ($model as $key => $value)
        {
            if ($value != null && $key != 'db' && $key != 'table')
            {
                $keys[] = "$key = ?";
                $values[] = $value;
            }
        }
        $values[] = $id;
        
        $listsKeys = implode(', ', $keys);

        return $this->requete('UPDATE '.$this->table. ' SET '. $listsKeys.' WHERE id = ?', $values);
    }

    // delete
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM $this->table WHERE id=?", [$id]);
    }

    
  // lancer la requete
  public function requete(string $sql, array $attributs = null)
  {
    // on récupère une instance de bdd
    $this->cnx = Cnx::getInstance();

    //On vérifie si on a des attributs
    if ($attributs !== null)
    {
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