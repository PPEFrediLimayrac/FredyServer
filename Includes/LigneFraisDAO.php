<?php

include_once "LigneFrais.php";
include_once "AvancerDAO.php";
include_once "IndemniteDAO.php";
include_once "MotifDAO.php";
include_once "DAO.php";

class LigneFraisDAO extends DAO{


function findAllBy($pseudo_Demandeur, $annee) {
    $sql = "select avancer.id_NoteDeFrais, LigneFrais.id_frais, LigneFrais.dateLigneFrais,trajet_frais, km_frais, cout_trajet, cout_peage, cout_repas, cout_hebergement, Adherent
      from LigneFrais, NoteDeFrais, Demandeur, avancer
      where Demandeur.id_Demandeur=avancer.id_Demandeur
      and avancer.id_frais=LigneFrais.id_frais
      and NoteDeFrais.id_NoteDeFrais = avancer.id_NoteDeFrais
      
      and pseudo_Demandeur = :pseudo_Demandeur
      and NoteDeFrais.annee_NoteDeFrais = :annee;";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":pseudo_Demandeur" => $pseudo_Demandeur,
                          ":annee" => $annee ));
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }

    $tableau = array();
    foreach ($rows as $row) {
      $tableau[] = new LigneFrais($row);
    }
    return $tableau; // Retourne un tableau d'objets
  }

  function findById($id) {
    $sql = "select * From LigneFrais where id_frais=:id";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":id" => $id));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $tableau = array();
      
      $r = new LigneFrais($row);
      
     return $r;
     // Retourne un tableau d'objets
  }

function delete($id) {
    $sql = "SET FOREIGN_KEY_CHECKS=0;
DELETE FROM LigneFrais WHERE
 LigneFrais.id_frais=:id ;

SET FOREIGN_KEY_CHECKS=1;";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":id" => $id));;
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
   
  }  
  

 function update($dateLigneFrais, $Adherent ,$trajet_frais, $km_frais , $cout_trajet, $cout_peage, $cout_hebergement, $cout_repas,$idBordereau){
     $sql = " UPDATE `LigneFrais` SET `dateLigneFrais`=:dateLigneFrais,`Adherent`=:Adherent,`trajet_frais`=:trajet_frais,`km_frais`=:km_frais,`cout_trajet`=:cout_trajet,`cout_peage`=:cout_peage,`cout_hebergement`=:cout_hebergement,`cout_repas`=:cout_repas WHERE LigneFrais.id_frais=:idBordereau
";

    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":cout_trajet" => $cout_trajet,
        ":Adherent" => $Adherent,
        ":dateLigneFrais" => $dateLigneFrais,
        ":trajet_frais" => $trajet_frais,
        ":km_frais" => $km_frais,
        ":cout_peage" => $cout_peage,
        ":cout_hebergement" => $cout_hebergement,
        ":cout_repas" => $cout_repas,
        ":idBordereau" => $idBordereau
                ));;
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }


  function insert($dateLigneFrais,$Adherent ,$trajet_frais, $km_frais , $cout_trajet, $cout_peage, $cout_hebergement, $cout_repas){
  	 $sql = "insert into LigneFrais (dateLigneFrais,Adherent ,trajet_frais, km_frais , cout_trajet, cout_peage, cout_hebergement, cout_repas) values (:dateLigneFrais ,:Adherent,:trajet_frais, :km_frais , :cout_trajet, :cout_peage, :cout_hebergement, :cout_repas) ";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":cout_trajet" => $cout_trajet,
        ":Adherent" => $Adherent,
      	":dateLigneFrais" => $dateLigneFrais,
      	":trajet_frais" => $trajet_frais,
      	":km_frais" => $km_frais,
      	":cout_peage" => $cout_peage,
      	":cout_hebergement" => $cout_hebergement,
      	":cout_repas" => $cout_repas,
      	      	));;
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }

   $sql = "SELECT LAST_INSERT_ID() FROM LigneFrais";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array());;
       $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
return $row;

}

function insertAvancer($idLigneFrais, $idBordereau, $pseudo){

	   $sql = "SELECT id_Demandeur FROM Demandeur where pseudo_Demandeur=:pseudo";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":pseudo" => $pseudo));
       $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    print_r($row);

  	 $sql = "insert into avancer(id_Demandeur, id_frais, id_NoteDeFrais) values (:id_Demandeur, :id_frais, :id_NoteDeFrais)";
    try {
      $sth = self::get_connexion()->prepare($sql);
      $sth->execute(array(":id_frais" => $idLigneFrais,
      	":id_NoteDeFrais" => $idBordereau,
      	":id_Demandeur" => $row['id_Demandeur']));
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }


}


}