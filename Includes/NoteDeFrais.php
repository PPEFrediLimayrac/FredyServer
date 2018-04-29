<?php

include_once "NoteDeFraisDAO.php";
class NoteDeFrais extends NoteDeFraisDAO{
 

  private $id_NoteDeFrais;
  private $annee_NoteDeFrais;

  private $id_Motif;
  private $id_Indemnite;

  private $les_lignesDeFrais;
  private $id_Demandeur;


 function __construct(array $tableau = null) {
    if (isset($tableau)) {
      $this->hydrater($tableau);
    }
  }

function get_id_NoteDeFrais() {
    return $this->id_NoteDeFrais;
  }

function get_annee_NoteDeFrais() {
    return $this->annee_NoteDeFrais;
  }

function get_id_Motif() {
    return $this->id_Motif;
  }

function get_id_Indemnite() {
    return $this->id_Indemnite;
  }
  function get_id_Demandeur() {
    return $this->id_Demandeur;
  }
function get_les_lignesDeFrais() {
    return $this->les_lignesDeFrais;
  }


//setter

   function set_id_NoteDeFrais($id_NoteDeFrais) {
    $this->id_NoteDeFrais = $id_NoteDeFrais;
  }

  function set_annee_NoteDeFrais($annee_NoteDeFrais) {
    $this->annee_NoteDeFrais = $annee_NoteDeFrais;
  }

  function set_id_Motif($id_Motif) {
    $this->id_Motif = $id_Motif;
  }

 function set_id_Indemnite($id_Indemnite) {
    $this->id_Indemnite = $id_Indemnite;
  }
  function set_id_Demandeur($id_Demandeur) {
    $this->id_Demandeur = $id_Demandeur;
  }
   function set_les_lignesDeFrais($les_lignesDeFrais) {
    $this->les_lignesDeFrais = $les_lignesDeFrais;
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