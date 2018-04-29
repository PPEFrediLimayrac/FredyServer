<?php


include_once "Demandeur.php";
include_once "AdherentDAO.php";
include_once "RepresentantDAO.php";
include_once "DAO.php";



class DemandeurDAO extends DAO {




function find($pseudo_Demandeur, $mdp_Demandeur) {
  $connexion = $this->get_connexion();
    $sql = "select Demandeur.pseudo_Demandeur, Demandeur.mdp_Demandeur from Demandeur where pseudo_Demandeur=:pseudo_Demandeur and mdp_Demandeur=:mdp_Demandeur";
    try {
      $sth = $connexion->prepare($sql);
      $sth->execute(array(":pseudo_Demandeur" => $pseudo_Demandeur,
                          ":mdp_Demandeur" => $mdp_Demandeur));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $pseudo = $row ; 
    return $pseudo ;
    }


function insert_Demandeur(Demandeur $Demandeur_object) {

 $connexion = $this->get_connexion();
 $sql = "INSERT INTO Demandeur(pseudo_Demandeur ,mdp_Demandeur ,mail_Demandeur, nom, prenom, adresse ) VALUES ( :pseudo_Demandeur, :mdp_Demandeur, :mail_Demandeur, :nom, :prenom, :adresse)";
 try {
   $sth = $connexion->prepare($sql);

   $sth->execute(
           array(
               ":pseudo_Demandeur" => $Demandeur_object->get_pseudo_Demandeur(),   
                ":mdp_Demandeur" => $Demandeur_object->get_mdp_Demandeur(),
                ":mail_Demandeur" => $Demandeur_object->get_mail_Demandeur(),
                ":nom" => $Demandeur_object->get_nom(),
                ":prenom" => $Demandeur_object->get_prenom(),  
                ":adresse" => $Demandeur_object->get_adresse()    
   ));

 } catch (PDOException $e) {
   throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
 }


 /*$nb = $sth->rowcount();
 return $nb;  // Retourne le nombre d'insertion*/
}

}

?>

