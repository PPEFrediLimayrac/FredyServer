<?php


class Motif {
 

  private $id_Motif;
  private $libelle_Motif;

 


 function __construct(array $tableau = null) {
    if (isset($tableau)) {
      $this->hydrater($tableau);
    }
  }

function get_id_Motif() {
    return $this->id_Motif;
  }

function get_libelle_Motif() {
    return $this->libelle_Motif;
  }





//setter

   function set_id_Motif($id_Motif) {
    $this->id_Motif = $id_Motif;
  }

  function set_libelle_Motif($libelle_Motif) {
    $this->libelle_Motif = $libelle_Motif;
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