<?php



include_once "DAO.php";




class BloqueDAO extends DAO{


function findAllBy($pseudo_Demandeur, $annee) {
    $sql = "select id_bloque from bloque where annee_bloque = :annee and nom_bloque = :nom";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":nom" => $pseudo_Demandeur,
                          ":annee" => $annee ));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }

   
    return $row; // Retourne un tableau d'objets
  }

  function insert($pseudo_Demandeur, $annee) {
    $sql = "insert into bloque (annee_bloque,nom_bloque) values (:annee , :nom)";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":nom" => $pseudo_Demandeur,
                          ":annee" => $annee ));
      
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
 
  }

}