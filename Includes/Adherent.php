<?php

include_once "AdherentDAO.php";

class adherent extends adherentDAO{
  //attributs de la classe
  
  private $id_adherent;
  private $licence_adherent;
  private $id_Demandeur;
  private $nom_adherent;
  private $prenom_adherent;
  private $date_naissance;
  private $rue_adherent;
  private $cp_adherent;
  private $ville_adherent;
  private $sexe_adherent;
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


  public function get_id_adherent() {
    return $this->id_adherent;
  }
  public function get_id_Demandeur() {
    return $this->id_Demandeur;
  }
  public function get_licence_adherent() {
    return $this->licence_adherent;
  }
  public  function get_nom_adherent() {
    return $this->nom_adherent;
  }
  public function get_prenom_adherent() {
    return $this->prenom_adherent;
  }
  public function get_date_naissance() {
    return $this->date_naissance;
  }
  public function get_rue_adherent() {
    return $this->rue_adherent;
  }
  public function get_cp_adherent() {
    return $this->cp_adherent;
  }
  public function get_ville_adherent() {
    return $this->ville_adherent;
  }
  public function get_sexe_adherent() {
    return $this->sexe_adherent;
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
  function set_id_adherent($id_adherent) {
    $this->id_adherent = $id_adherent;
  }
function set_licence_adherent($licence_adherent) {
    $this->licence_adherent = $licence_adherent;
  }

  function set_nom_adherent($nom_adherent) {
    $this->nom_adherent = $nom_adherent;
  }
 function set_prenom_adherent($prenom_adherent) {
    $this->prenom_adherent = $prenom_adherent;
  } 
  function set_date_naissance($date_naissance) {
    $this->date_naissance = $date_naissance;
  } 
  function set_rue_adherent($rue_adherent) {
    $this->rue_adherent = $rue_adherent;
  }
  function set_cp_adherent($cp_adherent) {
    $this->cp_adherent = $cp_adherent;
  }
   function set_ville_adherent($ville_adherent) {
    $this->ville_adherent = $ville_adherent;
  }
   function set_sexe_adherent($sexe_adherent) {
    $this->sexe_adherent = $sexe_adherent;
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