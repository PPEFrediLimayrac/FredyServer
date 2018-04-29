<?php

include_once "IndemniteDAO.php";

class Indemnite extends IndemniteDAO {
 

  private $id_Indemnite;
  private $annee_Indemnite;
  private $tarif_kilometrique;
 


 function __construct(array $tableau = null) {
    if (isset($tableau)) {
      $this->hydrater($tableau);
    }
  }

function get_id_Indemnite() {
    return $this->id_Indemnite;
  }

function get_annee_Indemnite() {
    return $this->annee_Indemnite;
  }

function get_tarif_kilometrique() {
    return $this->tarif_kilometrique;
  }



//setter

   function set_id_Indemnite($id_Indemnite) {
    $this->id_Indemnite = $id_Indemnite;
  }

  function set_annee_Indemnite($annee_Indemnite) {
    $this->annee_Indemnite = $annee_Indemnite;
  }

  function set_tarif_kilometrique($tarif_kilometrique) {
    $this->tarif_kilometrique = $tarif_kilometrique;
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