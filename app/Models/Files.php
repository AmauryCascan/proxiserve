<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;

class Files extends CoreModel
{
    private $fileName;
    private $id_bt;

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `files`';
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    public static function findByBt($id)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `files` WHERE id_bt = ' . $id ;
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }


    public static function find($id)
    {
        // récupérer un objet PDO = connexion à la BDD
        $pdo = Database::getPDO();

        // on écrit la requête SQL pour récupérer le produit
        $sql = '
            SELECT *
            FROM `files`
            WHERE id = ' . $id;

        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }

    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();
        
        // Ecriture de la requête INSERT INTO
        $sql = "INSERT INTO `files` (fileName, id_bt)
                VALUES (:fileName, :id_bt)
        ";
        
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':fileName', $this->fileName);
        $stmt->bindParam(':id_bt', $this->id_bt);
       
        
        $success = $stmt->execute();
        // Si au moins une ligne ajoutée
        if ($success > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }

        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }

    public function update()
    {
        
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "UPDATE `files`
            SET `fileName` = :fileName,
                `id_bt` = :id_bt,
                
            WHERE id = :id
        ";
        
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':fileName', $this->fileName);
        $stmt->bindParam(':id_bt', $this->id_bt);
        $stmt->bindParam(':id', $this->id);
        
        $sucess = $stmt->execute();
        
        // On retourne VRAI, si au moins une ligne ajoutée
        return ($sucess > 0);
    }

    public function delete()
    {
        $pdo = Database::getPDO();

        
        $sql = "DELETE FROM `files` WHERE id = :id";

     
        $stmt = $pdo->prepare($sql);
        
     
        
        $stmt->bindParam(':id', $this->id);
        
        
        $sucess = $stmt->execute();

        return ($sucess > 0);
    }

        


    /**
     * Get the value of fileName
     */ 
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     *
     * @return  self
     */ 
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get the value of id_bt
     */ 
    public function getId_bt()
    {
        return $this->id_bt;
    }

    /**
     * Set the value of id_bt
     *
     * @return  self
     */ 
    public function setId_bt($id_bt)
    {
        $this->id_bt = $id_bt;

        return $this;
    }
}
