<?php

include_once "LigueDAO.php";
include_once "DAO.php";

class ClubDAO extends DAO{

	function findIdClub() {
      $sql = "select id_Club, nom_Club From Club";
      try {
        $sth = self::get_connexion()->prepare($sql);
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      $r = new Club($row);
        
      return $r;
       // Retourne un tableau d'objets
    }

    function findAll() {
      $sql = "SELECT * FROM Club";
      try {
        $sth = self::get_connexion()->prepare($sql);
        $sth->execute();
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      $tableau = array();
      foreach ($rows as $row) {
        $tableau[] = new Adherent($row);
      }
      return $tableau;
    }

}