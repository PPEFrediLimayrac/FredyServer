<?php

require_once 'ClubDAO.php';

class Club extends ClubDAO{

  private $id_Club;
  private $nom_Club;
  private $adresse_Club;
  private $cp_Club;
  private $ville_Club;
  private $sigle_Club;
  private $nom_president;
  private $id_Ligue;


   function __construct(array $tableau = null) {
    if (isset($tableau)) {
      $this->hydrater($tableau);
    }
  }


// getters de la classe
  public function get_id_Club() {
    return $this->id_Club;
  }

 public  function get_nom_Club() {
    return $this->nom_Club;
  }

 public function get_adresse_Club() {
    return $this->adresse_Club;
  }
 public function get_cp_Club() {
    return $this->cp_Club;
  }
  public function get_ville_Club() {
    return $this->ville_Club;
  }
  public function get_sigle_Club() {
    return $this->sigle_Club;
  }
  public function get_nom_president() {
    return $this->nom_president;
  }
  public function get_id_Ligue() {
    return $this->id_Ligue;
  }

//setters de la classe

function set_id_Club($id_Club) {
    $this->id_Club = $id_Club;
  }

  function set_nom_Club($nom_Club) {
    $this->nom_Club = $nom_Club;
  }
 function set_adresse_Club($adresse_Club) {
    $this->adresse_Club= $adresse_Club;
  } 
  function set_cp_Club($cp_Club) {
    $this->cp_Club = $cp_Club;
  } 
  function set_ville_Club($ville_Club) {
    $this->ville_Club = $ville_Club;
  }
 
 function set_sigle_Club($sigle_Club) {
    $this->sigle_Club = $sigle_Club;
  }
   function set_nom_president($nom_president) {
    $this->nom_president = $nom_president;
  }
  function set_id_Ligue($id_Ligue) {
    $this->id_Ligue = $id_Ligue;
  }

  
    function hydrater(array $tableau) {
    foreach ($tableau as $cle => $valeur) {
      $methode = 'set_' . $cle;
      if (method_exists($this, $methode)) {
        $this->$methode($valeur);
      }
    }
  }
  
}