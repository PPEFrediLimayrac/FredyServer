<?php
//
// top14server - Serveur web service RESTful
//
// Authentifie un client Android et renvoie une réponse JSON
// Exemple : http://192.168.26.1/Fredy/API/login.php?user=jef&password=jefjef
include "../Includes/DemandeurDAO.php";
include "../Includes/LigneFrais.php";
include "../Hashage.php";
include "inc/fonctions.inc.php";

//require_once "../src/config/init.php";



// Récupère les paramètres dans l'URL
$user = isset($_GET["user"]) ? $_GET["user"] : "";
$password = isset($_GET["password"]) ? $_GET["password"] : "";
$password = hashage($password);

// Vérifie si le user existe
if (isset($user) && isset($password)) {
	if($user != "" && $password != ""){
		//$DemandeurDAO = new DemandeurDAO();
		//$Demandeur = $DemandeurDAO->findAllByMail($user);

		$DemandeurDAO = new DemandeurDAO();
        $Demandeur = $DemandeurDAO->find($user, $password);
		
		if(  $Demandeur['pseudo_Demandeur']== $user && $Demandeur['mdp_Demandeur']== $password ){
		 $_SESSION['pseudo_Demandeur'] = $user;
		//$Demandeur = serialize($_SESSION['Demandeur']);
      	//$Demandeur = unserialize($Demandeur);
      	/*echo "<pre>";
		print_r($Demandeur);
		echo "</pre>";*/
		$trouve = null;
		 $LigneFrais = new LigneFrais();
		 $rows = $LigneFrais->findAllBy($_SESSION['pseudo_Demandeur'],date('YY'));



			foreach ($rows as $LigneFrais) {
				if($LigneFrais->get_dateLigneFrais() == date("Y")){
					$myLigne = array(
					 // "id_Ligne" => $ligne->get_Id_Ligne(), 
					  "Date" => $LigneFrais->get_dateLigneFrais(), 
					  "Km" => $LigneFrais->get_km_frais(), 
					  "CoutPeage" => $LigneFrais->get_cout_peage(),  
					  "CoutRepas" =>$LigneFrais->get_cout_repas(), 
					  "CoutHebergement" => $LigneFrais->get_cout_hebergement(),  
					  "Trajet" => $LigneFrais->get_trajet_frais(),      
					  "Adherent" => $LigneFrais->get_Adherent()  
					);
					$trouve[] = $myLigne;
				}
			}
		
		if($trouve != null){
			// $lesLignes = array(
			// 	"lesLignes" => $trouve
			// );
			$lesLignes = $trouve;
		}else {
			$lesLignes = "aucune ligne dans l'année courante";
		}
		 // Crée un token aléatoire (<PHP7)
		 $token = bin2hex(openssl_random_pseudo_bytes(15));
		 // Ajoute le token au fichier des tokens
		 add_token($token);
		}else{
			$lesLignes = "nope";
			$token = null;
		}
	}  
} else {
  $lesLignes = "user non authentifié";
  $token = null;
}

// Construit le format JSON
$json = build_json($lesLignes, $token, NULL);
// Envoie la réponse 
send_json($json);