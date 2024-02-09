<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;

class Bc extends CoreModel
{
    private $years;
    private $bc;
    private $date;
    private $type;
    private $price;
    private $etat;
    private $rdv;
    private $commentaire;
    private $document;
    private $commande;


    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `bc`';
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    public static function findNonFacture()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM bc WHERE etat != 'Facturé' AND etat != 'Terminé' AND etat != 'Annulé' ORDER BY `id` DESC";
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    public static function findFacture()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM bc WHERE etat = 'Facturé' OR etat = 'Terminé'  ORDER BY `etat` DESC";
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    public static function findAnnule()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM bc WHERE etat = 'Annulé'  ORDER BY `id` DESC";
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
            FROM `bc`
            WHERE id = ' . $id;

        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }

    /**
     * Méthode permettant d'ajouter un enregistrement dans la table bt
     * L'objet courant doit contenir toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     *
     * @return bool
     */
    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();
        
        // Ecriture de la requête INSERT INTO
        $sql = "INSERT INTO `bc` (years, bc, date, type, price, etat, rdv, commentaire, document, commande)
                VALUES (:years, :bc, :date, :type, :price, :etat, :rdv, :commentaire, :document, :commande)
        ";
        
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':years', $this->years);
        $stmt->bindParam(':bc', $this->bc);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':etat', $this->etat);
        $stmt->bindParam(':rdv', $this->rdv);
        $stmt->bindParam(':commentaire', $this->commentaire);
        $stmt->bindParam(':document', $this->document);
        $stmt->bindParam(':commande', $this->commande);
        
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
        $sql = "UPDATE `bc`
            SET `years` = :years,
                `bc` = :bc,
                `date` = :date,
                `type` = :type,
                `price` = :price,
                `etat` = :etat,
                `rdv` = :rdv,
                `commentaire` = :commentaire,
                `document` = :document,
                `commande` = :commande
            WHERE `id` = :id
        ";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':years', $this->years);
        $stmt->bindParam(':bc', $this->bc);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':etat', $this->etat);
        $stmt->bindParam(':rdv', $this->rdv);
        $stmt->bindParam(':commentaire', $this->commentaire);
        $stmt->bindParam(':document', $this->document);
        $stmt->bindParam(':commande', $this->commande);
        $stmt->bindParam(':id', $this->id);

        $sucess = $stmt->execute();
    
        // On retourne VRAI, si au moins une ligne ajoutée
        return ($sucess > 0);
    }

    public function delete()
    {
        $pdo = Database::getPDO();

        
        $sql = "DELETE FROM `bc` WHERE id = :id";

     
        $stmt = $pdo->prepare($sql);
        
     
        
        $stmt->bindParam(':id', $this->id);
        
        
        $sucess = $stmt->execute();

        return ($sucess > 0);
    }

    public static function findByBc($bc)
    {
         // récupérer un objet PDO = connexion à la BDD
         $pdo = Database::getPDO();

         // on écrit la requête SQL pour récupérer le produit
         $sql = "
             SELECT *
             FROM `bc`
             WHERE bc = {$bc} ";
 
         $pdoStatement = $pdo->query($sql);
 
         $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
         return $results;
    }

    public static function findByType($type)
    {
         // récupérer un objet PDO = connexion à la BDD
         $pdo = Database::getPDO();

         // on écrit la requête SQL pour récupérer le produit
         $sql = "
             SELECT *
             FROM `bc`
             WHERE type = '{$type}' ";
 
         $pdoStatement = $pdo->query($sql);
 
         $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
         return $results;
    }


    public static function findByEtat($etat)
    {
         // récupérer un objet PDO = connexion à la BDD
         $pdo = Database::getPDO();

         // on écrit la requête SQL pour récupérer le produit
         $sql = "
             SELECT *
             FROM `bc`
             WHERE etat = '{$etat}' ";
 
         $pdoStatement = $pdo->query($sql);
         $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
         return $results;
    }

    /**
     * Get the value of years
     */ 
    public function getYears()
    {
        return $this->years;
    }

    /**
     * Set the value of years
     *
     * @return  self
     */ 
    public function setYears($years)
    {
        $this->years = $years;

        return $this;
    }

    /**
     * Get the value of bc
     */ 
    public function getBc()
    {
        return $this->bc;
    }

    /**
     * Set the value of bc
     *
     * @return  self
     */ 
    public function setBc($bc)
    {
        $this->bc = $bc;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of etat
     */ 
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set the value of etat
     *
     * @return  self
     */ 
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get the value of rdv
     */ 
    public function getRdv()
    {
        return $this->rdv;
    }

    /**
     * Set the value of rdv
     *
     * @return  self
     */ 
    public function setRdv($rdv)
    {
        $this->rdv = $rdv;

        return $this;
    }

    /**
     * Get the value of commentaire
     */ 
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set the value of commentaire
     *
     * @return  self
     */ 
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get the value of document
     */ 
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set the value of document
     *
     * @return  self
     */ 
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get the value of commande
     */ 
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set the value of commande
     *
     * @return  self
     */ 
    public function setCommande($commande)
    {
        $this->commande = $commande;

        return $this;
    }
}
    
