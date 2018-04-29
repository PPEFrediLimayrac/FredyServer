<?php


//include_once "Adherent.php";
include_once "ClubDAO.php";
include_once "DAO.php";

class adherentDAO extends DAO {

  function findAllByPseudo($pseudo_Demandeur) {
      $sql = "SELECT licence_adherent, nom_adherent, prenom_adherent, date_naissance, rue_adherent, cp_adherent, ville_adherent, sexe_adherent, nom_Club, libelle_Ligue, id_adherent
        FROM adherent, Demandeur, Club, Ligue
        WHERE Demandeur.id_Demandeur=adherent.id_Demandeur
        AND adherent.id_Club=Club.id_Club
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
        $tableau[] = new adherent($row);

      }
      return $tableau; // Retourne un tableau d'objets
  }


    function insert_adherent(adherent $adherent_object, $pseudo_Demandeur) {

        $sql = "select id_Demandeur From Demandeur where pseudo_Demandeur=:pseudo_Demandeur";
      try {
        $sth = self::get_connexion()->prepare($sql);
        $sth->execute(array(":pseudo_Demandeur" => $pseudo_Demandeur));
        $result = $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      


          $connexion = $this->get_connexion();
          $sql = "insert into adherent(licence_adherent,nom_adherent,prenom_adherent,date_naissance,rue_adherent,cp_adherent,ville_adherent,sexe_adherent,id_Club, id_Demandeur) Values (:licence_adherent,:nom_adherent,:prenom_adherent,:date_naissance,:rue_adherent,:cp_adherent,:ville_adherent,:sexe_adherent,:id_Club, :id_Demandeur) ";
          try 
          {
            $sth = $connexion->prepare($sql);
            $sth->execute(
              array(
                  ":licence_adherent" => $adherent_object->get_licence_adherent(),
                  ":nom_adherent" => $adherent_object->get_nom_adherent(),
                  ":prenom_adherent" => $adherent_object->get_prenom_adherent(),
                  ":date_naissance" => $adherent_object->get_date_naissance(),
                  ":rue_adherent" => $adherent_object->get_rue_adherent(),
                  ":cp_adherent" => $adherent_object->get_cp_adherent(),
                  ":ville_adherent" => $adherent_object->get_ville_adherent(),
                  ":sexe_adherent" => $adherent_object->get_sexe_adherent(),
                  ":id_Club" => $adherent_object->get_id_Club(),
                  ":id_Demandeur" => $result['id_Demandeur']
              )
            );
    			}catch (PDOException $e) 
          {
              throw new Exception("Erreur lors de la connexion : " . $e->getMessage());
          }
    }


    function findByID($id_adherent) {
      $sql = "select * From adherent where id_adherent=:id_adherent";
      try {
        $sth = self::get_connexion()->prepare($sql);
        $sth->execute(array(":id_adherent" => $id_adherent));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      $r = new adherent($row);
        
      return $r;
       // Retourne un tableau d'objets
    }

    function deleteAdh($id) {
    $sql = "SET FOREIGN_KEY_CHECKS=0;
            DELETE FROM adherent WHERE
            adherent.id_adherent=:id ;
            SET FOREIGN_KEY_CHECKS=1;";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":id" => $id));
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
   
  }  
  

 function update($licence_adherent,$nom_adherent,$prenom_adherent,$date_naissance,$rue_adherent,$cp_adherent,$ville_adherent,$sexe_adherent, $id_adherent){
     $sql = " UPDATE `adherent` SET `licence_adherent`=:licence_adherent,`nom_adherent`=:nom_adherent,`prenom_adherent`=:prenom_adherent,`date_naissance`=:date_naissance,`cp_adherent`=:cp_adherent,`rue_adherent`=:rue_adherent,`ville_adherent`=:ville_adherent, `sexe_adherent`=:sexe_adherent WHERE adherent.id_adherent=:id_adherent";

    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":licence_adherent" => $licence_adherent,
        ":nom_adherent" => $nom_adherent,
        ":prenom_adherent" => $prenom_adherent,
        ":date_naissance" => $date_naissance,
        ":rue_adherent" => $rue_adherent,
        ":cp_adherent" => $cp_adherent,
        ":ville_adherent" => $ville_adherent,
        ":sexe_adherent" => $sexe_adherent,
        ":id_adherent" => $id_adherent
                ));;
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }
}
?>