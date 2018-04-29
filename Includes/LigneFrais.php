<?php

include_once "LigneFraisDAO.php";
class LigneFrais extends LigneFraisDAO{
 

  private $id_frais;
  private $dateLigneFrais;
  private $trajet_frais;
  private $km_frais;
  private $cout_trajet;
  private $cout_peage;
  private $cout_hebergement;
  private $cout_repas;
  private $id_Motif;
  private $id_Indemnite;
private $adherent;
  private $id_NoteDeFrais; 
 


  function __construct(array $tableau = null) {
    if (isset($tableau)) {
      $this->hydrater($tableau);
    }
  }

function get_id_frais() {
    return $this->id_frais;
  }
  function get_adherent(){
    return $this->adherent;
  }

function get_dateLigneFrais() {
    return $this->dateLigneFrais;
  }

function get_trajet_frais() {
    return $this->trajet_frais;
  }

function get_km_frais() {
    return $this->km_frais;
  }

function get_cout_trajet() {
    return $this->cout_trajet;
  }

function get_cout_peage() {
    return $this->cout_peage;
  }

function get_cout_hebergement() {
    return $this->cout_hebergement;
  }

function get_cout_repas() {
    return $this->cout_repas;
  }
function get_id_NoteDeFrais() {
    return $this->id_NoteDeFrais;
  }
function get_id_Motif() {
    return $this->id_Motif;
  }

function get_id_Indemnite() {
    return $this->id_Indemnite;
  }  



//setter

   function set_id_frais($id_frais) {
    $this->id_frais = $id_frais;
  }

  function set_dateLigneFrais($dateLigneFrais) {
    $this->dateLigneFrais = $dateLigneFrais;
  }

   function set_trajet_frais($trajet_frais) {
    $this->trajet_frais = $trajet_frais;
  }
   function set_km_frais($km_frais) {
     $this->km_frais = $km_frais;
  }
  function set_cout_trajet($cout_trajet) {
    $this->cout_trajet = $cout_trajet;
  }
   function set_cout_peage($cout_peage) {
    $this->cout_peage = $cout_peage;
  }
   function set_cout_hebergement($cout_hebergement) {
     $this->cout_hebergement = $cout_hebergement;
  }
  function set_adherent($adherent) {
     $this->adherent = $adherent;
  }
  function set_cout_repas($cout_repas) {
    $this->cout_repas = $cout_repas;
  }
  function set_id_NoteDeFrais($id_NoteDeFrais) {
    $this->id_NoteDeFrais = $id_NoteDeFrais;
  }
  function set_id_Motif($id_Motif) {
    $this->id_Motif = $id_Motif;
  }

 function set_id_Indemnite($id_Indemnite) {
    $this->id_Indemnite = $id_Indemnite;
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