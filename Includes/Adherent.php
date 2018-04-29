<?php

include_once "AdherentDAO.php";

class Adherent extends AdherentDAO{
  //attributs de la classe
  
  private $id_Adherent;
  private $licence_Adherent;
  private $id_Demandeur;
  private $nom_Adherent;
  private $prenom_Adherent;
  private $date_naissance;
  private $rue_Adherent;
  private $cp_Adherent;
  private $ville_Adherent;
  private $sexe_Adherent;
  private $id_Club;
  private $nom_Club;
  private $libelle_Ligue;
  private $lesClubs;

    function __construct(array $tableau = null) {
    if (isset($tableau)) {
      $this->hydrater($tableau);
    }
  }


// getters de la classe


  public function get_id_Adherent() {
    return $this->id_Adherent;
  }
  public function get_id_Demandeur() {
    return $this->id_Demandeur;
  }
  public function get_licence_Adherent() {
    return $this->licence_Adherent;
  }
  public  function get_nom_Adherent() {
    return $this->nom_Adherent;
  }
  public function get_prenom_Adherent() {
    return $this->prenom_Adherent;
  }
  public function get_date_naissance() {
    return $this->date_naissance;
  }
  public function get_rue_Adherent() {
    return $this->rue_Adherent;
  }
  public function get_cp_Adherent() {
    return $this->cp_Adherent;
  }
  public function get_ville_Adherent() {
    return $this->ville_Adherent;
  }
  public function get_sexe_Adherent() {
    return $this->sexe_Adherent;
  }
  public function get_id_Club() {
    return $this->id_Club;
  }
  public function get_nom_Club() {
    return $this->nom_Club;
  }
  public function get_libelle_Ligue() {
    return $this->libelle_Ligue;
  }
  

  
//setters de la classe
  function set_id_Demandeur($id_Demandeur) {
    $this->id_Demandeur = $id_Demandeur;
  }
  function set_id_Adherent($id_Adherent) {
    $this->id_Adherent = $id_Adherent;
  }
function set_licence_Adherent($licence_Adherent) {
    $this->licence_Adherent = $licence_Adherent;
  }

  function set_nom_Adherent($nom_Adherent) {
    $this->nom_Adherent = $nom_Adherent;
  }
 function set_prenom_Adherent($prenom_Adherent) {
    $this->prenom_Adherent = $prenom_Adherent;
  } 
  function set_date_naissance($date_naissance) {
    $this->date_naissance = $date_naissance;
  } 
  function set_rue_Adherent($rue_Adherent) {
    $this->rue_Adherent = $rue_Adherent;
  }
  function set_cp_Adherent($cp_Adherent) {
    $this->cp_Adherent = $cp_Adherent;
  }
   function set_ville_Adherent($ville_Adherent) {
    $this->ville_Adherent = $ville_Adherent;
  }
   function set_sexe_Adherent($sexe_Adherent) {
    $this->sexe_Adherent = $sexe_Adherent;
  }
  function set_id_Club($id_Club) {
      $this->id_Club = $id_Club;
  }
  function set_nom_Club($nom_Club){
      $this->nom_Club = $nom_Club;
  }
  function set_libelle_Ligue($libelle_Ligue) {
      $this->libelle_Ligue = $libelle_Ligue;
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