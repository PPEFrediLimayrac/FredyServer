<?php


//include_once "Adherent.php";
include_once "ClubDAO.php";
include_once "DAO.php";

class AdherentDAO extends DAO {

  function findAllByPseudo($pseudo_Demandeur) {
      $sql = "SELECT licence_Adherent, nom_Adherent, prenom_Adherent, date_naissance, rue_Adherent, cp_Adherent, ville_Adherent, sexe_Adherent, nom_Club, libelle_Ligue, id_Adherent
        FROM Adherent, Demandeur, Club, Ligue
        WHERE Demandeur.id_Demandeur=Adherent.id_Demandeur
        AND Adherent.id_Club=Club.id_Club
        AND Club.id_Ligue = Ligue.id_Ligue 
        AND pseudo_Demandeur = :pseudo_Demandeur";
      try {
        $sth = self::get_connexion()->prepare($sql);
        $sth->execute(array(":pseudo_Demandeur" => $pseudo_Demandeur));
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      $tableau = array();
      foreach ($rows as $row) {
        $tableau[] = new Adherent($row);

      }
      return $tableau; // Retourne un tableau d'objets
  }


    function insert_Adherent(Adherent $Adherent_object, $pseudo_Demandeur) {

        $sql = "select id_Demandeur From Demandeur where pseudo_Demandeur=:pseudo_Demandeur";
      try {
        $sth = self::get_connexion()->prepare($sql);
        $sth->execute(array(":pseudo_Demandeur" => $pseudo_Demandeur));
        $result = $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      


          $connexion = $this->get_connexion();
          $sql = "insert into Adherent(licence_Adherent,nom_Adherent,prenom_Adherent,date_naissance,rue_Adherent,cp_Adherent,ville_Adherent,sexe_Adherent,id_Club, id_Demandeur) Values (:licence_Adherent,:nom_Adherent,:prenom_Adherent,:date_naissance,:rue_Adherent,:cp_Adherent,:ville_Adherent,:sexe_Adherent,:id_Club, :id_Demandeur) ";
          try 
          {
            $sth = $connexion->prepare($sql);
            $sth->execute(
              array(
                  ":licence_Adherent" => $Adherent_object->get_licence_Adherent(),
                  ":nom_Adherent" => $Adherent_object->get_nom_Adherent(),
                  ":prenom_Adherent" => $Adherent_object->get_prenom_Adherent(),
                  ":date_naissance" => $Adherent_object->get_date_naissance(),
                  ":rue_Adherent" => $Adherent_object->get_rue_Adherent(),
                  ":cp_Adherent" => $Adherent_object->get_cp_Adherent(),
                  ":ville_Adherent" => $Adherent_object->get_ville_Adherent(),
                  ":sexe_Adherent" => $Adherent_object->get_sexe_Adherent(),
                  ":id_Club" => $Adherent_object->get_id_Club(),
                  ":id_Demandeur" => $result['id_Demandeur']
              )
            );
    			}catch (PDOException $e) 
          {
              throw new Exception("Erreur lors de la connexion : " . $e->getMessage());
          }
    }


    function findByID($id_Adherent) {
      $sql = "select * From Adherent where id_Adherent=:id_Adherent";
      try {
        $sth = self::get_connexion()->prepare($sql);
        $sth->execute(array(":id_Adherent" => $id_Adherent));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      $r = new Adherent($row);
        
      return $r;
       // Retourne un tableau d'objets
    }

    function deleteAdh($id) {
    $sql = "SET FOREIGN_KEY_CHECKS=0;
            DELETE FROM Adherent WHERE
            Adherent.id_Adherent=:id ;
            SET FOREIGN_KEY_CHECKS=1;";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":id" => $id));
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
   
  }  
  

 function update($licence_Adherent,$nom_Adherent,$prenom_Adherent,$date_naissance,$rue_Adherent,$cp_Adherent,$ville_Adherent,$sexe_Adherent, $id_Adherent){
     $sql = " UPDATE `Adherent` SET `licence_Adherent`=:licence_Adherent,`nom_Adherent`=:nom_Adherent,`prenom_Adherent`=:prenom_Adherent,`date_naissance`=:date_naissance,`cp_Adherent`=:cp_Adherent,`rue_Adherent`=:rue_Adherent,`ville_Adherent`=:ville_Adherent, `sexe_Adherent`=:sexe_Adherent WHERE Adherent.id_Adherent=:id_Adherent";

    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":licence_Adherent" => $licence_Adherent,
        ":nom_Adherent" => $nom_Adherent,
        ":prenom_Adherent" => $prenom_Adherent,
        ":date_naissance" => $date_naissance,
        ":rue_Adherent" => $rue_Adherent,
        ":cp_Adherent" => $cp_Adherent,
        ":ville_Adherent" => $ville_Adherent,
        ":sexe_Adherent" => $sexe_Adherent,
        ":id_Adherent" => $id_Adherent
                ));;
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }
}
?>