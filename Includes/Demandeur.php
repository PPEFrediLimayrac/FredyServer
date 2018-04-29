<?php

class Demandeur 
{
  //attributs de la classe
  private $id_Demandeur;
  private $mail_Demandeur;
  private $mdp_Demandeur;
  private $pseudo_Demandeur;
  private $nom;
  private $prenom;  
  private $adresse;

   function __construct(array $tableau = null) {
    if (isset($tableau)) {
      $this->hydrater($tableau);
    }
  }


// getters de la classe
  public function get_id_Demandeur() {
    return $this->id_Demandeur;
  }

 public function get_pseudo_Demandeur() {
    return $this->pseudo_Demandeur;
  }


 public  function get_mail_Demandeur() {
    return $this->mail_Demandeur;
  }

 public function get_mdp_Demandeur() {
    return $this->mdp_Demandeur;
  }
 public function get_nom() {
    return $this->nom;
  }
 public function get_prenom() {
    return $this->prenom;
  }
 public function get_adresse() {
    return $this->adresse;
  }

//setters de la classe

function set_id_Demandeur($id_Demandeur) {
    $this->id_Demandeur = $id_Demandeur;
  }
function set_pseudo_Demandeur($pseudo_Demandeur) {
    $this->pseudo_Demandeur = $pseudo_Demandeur;
  }
  function set_mail_Demandeur($mail_Demandeur) {
    $this->mail_Demandeur = $mail_Demandeur;
  }
 function set_mdp_Demandeur($mdp_Demandeur) {
    $this->mdp_Demandeur = $mdp_Demandeur;
  } 
 function set_nom($nom) {
    $this->nom = $nom;
  } 
 function set_prenom($prenom) {
    $this->prenom = $prenom;
  } 
 function set_adresse($adresse) {
    $this->adresse = $adresse;
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