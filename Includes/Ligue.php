<?php

require_once 'LigueDAO.php';

class Ligue
{
  //attributs de la classe
  private $id_Ligue;
  private $libelle_Ligue;

 
   function __construct(array $tableau = null) {
    if (isset($tableau)) {
      $this->hydrater($tableau);
    }
  }


// getters de la classe
  public function get_id_Ligue() {
    return $this->id_Ligue;
  }

 public  function get_libelle_Ligue() {
    return $this->libelle_Ligue;
  }


//setters de la classe

function set_id_Ligue($id_Ligue) {
    $this->id_Ligue = $id_Ligue;
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