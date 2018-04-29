<?php


include_once "DAO.php";


class IndemniteDAO extends DAO{

	function findByannee($annee){
    $sql = "select tarif_kilometrique from Indemnite
      where annee_Indemnite = :annee ";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":annee" => $annee));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }

   return $row ; 
  }



}