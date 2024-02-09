<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;

class Bt extends CoreModel
{
    private $years;
    private $bt;
    private $type;
    private $secteur;
    private $start;
    private $end;
    private $person;
    private $etat;
    private $document;
    private $commentaire;
    private $commentaireVth;
    private $price;
    private $rdv;
    private $commande;


    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `bt`';
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    public static function findNonFacture()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM bt WHERE etat != 'Facturé' AND etat != 'Terminé' AND etat != 'Annulé' ORDER BY `id` DESC";
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    public static function findFacture()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM bt WHERE etat = 'Facturé' OR etat = 'Terminé'  ORDER BY `etat` DESC";
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    public static function findAnnule()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM bt WHERE etat = 'Annulé'  ORDER BY `id` DESC";
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
            FROM `bt`
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
        $sql = "INSERT INTO `bt` (years, bt, type, secteur, start, end, person, etat, document, commentaire, price, rdv, commande)
                VALUES (:years, :bt, :type, :secteur, :start, :end, :person, :etat, :document, :commentaire, :price, :rdv, :commande)
        ";
        
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':years', $this->years);
        $stmt->bindParam(':bt', $this->bt);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':secteur', $this->secteur);
        $stmt->bindParam(':start', $this->start);
        $stmt->bindParam(':end', $this->end);
        $stmt->bindParam(':person', $this->person);
        $stmt->bindParam(':etat', $this->etat);
        $stmt->bindParam(':document', $this->document);
        $stmt->bindParam(':commentaire', $this->commentaire);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':rdv', $this->rdv);
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
        $sql = "UPDATE `bt`
            SET `years` = :years,
                `bt` = :bt,
                `type` = :type,
                `secteur` = :secteur,
                `start` = :start,
                `end` = :end,
                `person` = :person,
                `etat` = :etat,
                `document` = :document,
                `commentaire` = :commentaire,
                `commentaireVth` = :commentaireVth,
                `price` = :price,
                `rdv` = :rdv,
                `commande` = :price
            WHERE id = :id
        ";
        
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':years', $this->years);
        $stmt->bindParam(':bt', $this->bt);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':secteur', $this->secteur);
        $stmt->bindParam(':start', $this->start);
        $stmt->bindParam(':end', $this->end);
        $stmt->bindParam(':person', $this->person);
        $stmt->bindParam(':etat', $this->etat);
        $stmt->bindParam(':document', $this->document);
        $stmt->bindParam(':commentaire', $this->commentaire);
        $stmt->bindParam(':commentaireVth', $this->commentaireVth);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':rdv', $this->rdv);
        $stmt->bindParam(':commande', $this->commande);
        $stmt->bindParam(':id', $this->id);
        
        $sucess = $stmt->execute();
        
        // On retourne VRAI, si au moins une ligne ajoutée
        return ($sucess > 0);
    }

    public function delete()
    {
        $pdo = Database::getPDO();

        
        $sql = "DELETE FROM `bt` WHERE id = :id";

     
        $stmt = $pdo->prepare($sql);
        
     
        
        $stmt->bindParam(':id', $this->id);
        
        
        $sucess = $stmt->execute();

        return ($sucess > 0);
    }

    public static function findByBt($bt)
    {
         // récupérer un objet PDO = connexion à la BDD
         $pdo = Database::getPDO();

         // on écrit la requête SQL pour récupérer le produit
         $sql = "
             SELECT *
             FROM `bt`
             WHERE bt = {$bt} ";
 
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
             FROM `bt`
             WHERE type = '{$type}' ";
 
         $pdoStatement = $pdo->query($sql);
 
         $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
         return $results;
    }

    public static function findBySecteur($secteur)
    {
         // récupérer un objet PDO = connexion à la BDD
         $pdo = Database::getPDO();

         // on écrit la requête SQL pour récupérer le produit
         $sql = "
             SELECT *
             FROM `bt`
             WHERE secteur = '{$secteur}' ";
 
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
             FROM `bt`
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
     * Get the value of bt
     */ 
    public function getBt()
    {
        return $this->bt;
    }

    /**
     * Set the value of bt
     *
     * @return  self
     */ 
    public function setBt($bt)
    {
        $this->bt = $bt;

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
     * Get the value of secteur
     */ 
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * Set the value of secteur
     *
     * @return  self
     */ 
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get the value of start
     */ 
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set the value of start
     *
     * @return  self
     */ 
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get the value of end
     */ 
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set the value of end
     *
     * @return  self
     */ 
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get the value of person
     */ 
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set the value of person
     *
     * @return  self
     */ 
    public function setPerson($person)
    {
        $this->person = $person;

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
     * Get the value of commentaireVTH
     */ 
    public function getCommentaireVth()
    {
        return $this->commentaireVth;
    }

    /**
     * Set the value of commentaireVTH
     *
     * @return  self
     */ 
    public function setCommentaireVth($commentaireVth)
    {
        $this->commentaireVth = $commentaireVth;

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