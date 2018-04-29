<?php


include_once "NoteDeFrais.php";
include_once "DAO.php";




class NoteDeFraisDAO extends DAO{



 function insert($date){

	   $sql = "insert into NoteDeFrais (annee_NoteDeFrais) values (:date)";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":date" => $date));
       
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    
  	$sql = "SELECT LAST_INSERT_ID() FROM NoteDeFrais";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array());;
       $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
return $row;



}
}