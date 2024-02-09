<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;

class Etat extends CoreModel
{
    
    private $name;


    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `etat`';
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }
    /**
     * Méthode permettant de récupérer un enregistrement de la table etat en fonction d'un id donné
     *
     * @param int $etatId ID de la marque
     * @return Etat
     */
    public static function find($etatId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = '
            SELECT *
            FROM etat
            WHERE id = ' . $etatId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $etat = $pdoStatement->fetchObject(self::class);

        // retourner le résultat
        return $etat;
    }


    /**
     * Méthode permettant d'ajouter un enregistrement dans la table etat
     * L'objet courant doit contenir toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     *
     * @return bool
     */
    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();
        
        // Ecriture de la requête INSERT INTO
        $sql = "INSERT INTO `etat` (name)
                VALUES (:name)
        ";
        
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $this->name);
        
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
        $sql = "UPDATE `etat`
            SET `name` = :name,
            `updated_at` = NOW()
            WHERE id = :id
        ";
        
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);
        
        $sucess = $stmt->execute();
        
        // On retourne VRAI, si au moins une ligne ajoutée
        return ($sucess > 0);
    }

    /**
     * Méthode permettant de supprimer un enregistrement dans la table etat
     * L'objet courant doit contenir l'id, et toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     *
     * @return bool
     */
    public function delete()
    {
        
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "DELETE FROM `etat` WHERE id = :id";

        // On prépare la requète
        $stmt = $pdo->prepare($sql);
        
        //On bind nos paramètres
        
        $stmt->bindParam(':id', $this->id);
        
        //On lance la requête d'insertion
        $sucess = $stmt->execute();
        // Execution de la requête de mise à jour (exec, pas query)
        

        // On retourne VRAI, si au moins une ligne ajoutée
        return ($sucess > 0);
    }


    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }
}