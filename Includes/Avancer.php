<?php

class Avancer
{
  //attributs de la classe
  private $id_NoteDeFrais;
  private $id_Demandeur;
  private $id_frais;


   function __construct(array $tableau = null) {
    if (isset($tableau)) {
      $this->hydrater($tableau);
    }
  }


// getters de la classe


   public function get_id_NoteDeFrais() {
    return $this->id_NoteDeFrais;
  }
  public function get_id_Demandeur() {
    return $this->id_Demandeur;
  }

 public  function get_id_frais() {
    return $this->id_frais;
  }

  
  
//setters de la classe

function set_id_NoteDeFrais($id_NoteDeFrais) {
    $this->id_NoteDeFrais = $id_NoteDeFrais;
  }
function set_prenom_Adherent($prenom_Adherent) {
    $this->prenom_Adherent = $prenom_Adherent;

}

function set_id_frais($id_frais) {
    $this->id_frais = $id_frais;
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