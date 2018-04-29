<?php

session_start();
include_once "LigneFrais.php";
include_once "NoteDeFrais.php";
include_once "Adherent.php";
$pseudo = $_SESSION['pseudo_Demandeur'];
$annee = isset($_POST['annee']) ? $_POST['annee'] : '';
$submit = isset($_POST['submit']) ? $_POST['submit'] : '';
$dateLigneFrais = isset($_POST['dateLigneFrais']) ? $_POST['dateLigneFrais'] : '';
$trajet_frais = isset($_POST['trajet_frais']) ? $_POST['trajet_frais'] : '';
$km_frais = isset($_POST['km_frais']) ? $_POST['km_frais'] : '';
$cout_trajet = isset($_POST['cout_trajet']) ? $_POST['cout_trajet'] : '';
$cout_peage = isset($_POST['cout_peage']) ? $_POST['cout_peage'] : '';
$cout_hebergement= isset($_POST['cout_hebergement']) ? $_POST['cout_hebergement'] : '';
$cout_repas = isset($_POST['cout_repas']) ? $_POST['cout_repas'] : '';
$idBordereau = isset($_POST['idBordereau']) ? $_POST['idBordereau'] : '';
$Adherent = isset($_POST['Adherent']) ? $_POST['Adherent'] : '';
 $Adherents = new Adherent();
$adh = $Adherents->findAllByPseudo($_SESSION['pseudo_Demandeur']);
$pseudo = $_SESSION['pseudo_Demandeur'];
if(empty($idBordereau)){
$idBordereau = $_GET['idBordereau'];
$annee = $_GET['annee'];}
$object = new LigneFrais();
$object = $object->findbyID($idBordereau);
$submit = isset($_POST['submit']);

?>

<!DOCTYPE html>
<html>
<head>
<title>Fredi</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="../Style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="../js/cufon-yui.js"></script>
  <script type="text/javascript" src="../js/arial.js"></script>
  <script type="text/javascript" src="../js/cuf_run.js"></script>
</head>
<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="../Index.php">Fredi</a></h1>

      </div>
        <?php
          include('menuprincipal.php');
        ?>
               
      <div class="clr"></div>
    </div>
  </div>
<div class="hbg">
    <div class="hbg_resize"> 
    	<div class="form_Ins_Un">
<?php
	echo "<form method='post' action='Modifier.php' style='position: center;'><br/>
	<table>
		<tr><td>Date</td><td><input type='date' name='dateLigneFrais'  value='".$object->get_dateLigneFrais()."'></td></tr>
		<tr><td>Adhérent</td><td><select name='Adherent' id='Adherent' required>";
		foreach($adh as $Adherents){
			if($Adherents->get_prenom_Adherent() == $object->get_Adherent()){
		echo ' <option selected value='.$Adherents->get_prenom_Adherent().'>'.$Adherents->get_prenom_Adherent().'</option>';}
		else {
			echo ' <option  value='.$Adherents->get_prenom_Adherent().'>'.$Adherents->get_prenom_Adherent().'</option>';
		}
		}
		

		echo "</select></td></tr><tr><td>Nom trajet</td><td><input type='text' name='trajet_frais'  value='".$object->get_trajet_frais()."'></td></tr>
		<tr><td>Kilomètres parcourus</td><td><input type='number' name='km_frais' value='".$object->get_km_frais()."'></td></tr>
		<input type='hidden' name='cout_trajet' value=".$object->get_cout_trajet().">
		<tr><td>Coût péage</td><td><input type='number' name='cout_peage' value='".$object->get_cout_peage()."'></td></tr>
		<tr><td>Coût Hébergement</td><td><input type='number' name='cout_hebergement'value=".$object->get_cout_hebergement()."><br/>
		<tr><td>Coût repas</td><td><input type='number' name='cout_repas' value='".$object->get_cout_repas()."'></td></tr>
			<input type='hidden' name ='idBordereau' value='".$idBordereau."'>
			<input type='hidden' name ='annee' value='".$annee."'>
		<tr><td><input type='submit' name='submit' value='Envoyer le formulaire'></td>
		
	</table>
	</form>";


	if ($submit){
	$object->update($dateLigneFrais ,$Adherent, $trajet_frais, $km_frais , $cout_trajet, $cout_peage, $cout_hebergement, $cout_repas,$idBordereau);
	header('Location: ../Bordereau.php?annee='.$annee.'');
	}
?>
		</div>
	</div>
</div>