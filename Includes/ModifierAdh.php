<?php
	session_start();
	include_once "Adherent.php";
	   include_once('Club.php');

	$id_Adherent=isset($_POST['id_Adherent']) ? $_POST['id_Adherent'] : '';
	$licence_Adherent=isset($_POST['licence_Adherent']) ? $_POST['licence_Adherent'] : '';
	$id_Club=isset($_POST['id_Club']) ? $_POST['id_Club'] : '';
	$nom_Adherent=isset($_POST['nom_Adherent']) ? $_POST['nom_Adherent'] : '';
	$prenom_Adherent=isset($_POST['prenom_Adherent']) ? $_POST['prenom_Adherent'] : '';
	$date_naissance=isset($_POST['date_naissance']) ? $_POST['date_naissance'] : '';
	$ville_Adherent=isset($_POST['ville_Adherent']) ? $_POST['ville_Adherent'] : '';
	$cp_Adherent=isset($_POST['cp_Adherent']) ? $_POST['cp_Adherent'] : '';
	$rue_Adherent=isset($_POST['rue_Adherent']) ? $_POST['rue_Adherent'] : '';
	$sexe_Adherent=isset($_POST['sexe_Adherent']) ? $_POST['sexe_Adherent'] : '';
	$ji = $_GET['ji'];
	$pseudo = $_SESSION['pseudo_Demandeur'];
	if(empty($id_Adherent)){
		$id_Adherent = $_GET['id_Adherent'];
	}

	$object = new Adherent();
	$object = $object->findByID($id_Adherent);
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
          include('MenuPrincipal.php');
        ?>
               
      <div class="clr"></div>
    </div>
  </div>
<div class="hbg">
    <div class="hbg_resize"> 
    	<div class="form_Ins_Un">
<?php
$Clubs = new Club();
    $rows2 = $Clubs->findAll();

	echo "<form method='post' action='ModifierAdh.php' style='position: center;'><br/>
		<table>
			<tr><td>Licence</td><td><input type='text' name='licence_Adherent' placeholder='licence_Adherent' value='".$object->get_licence_Adherent()."'></td></tr>
			<tr><td>Nom</td><td><input type='text' name='nom_Adherent' placeholder='nom_Adherent' value='".$object->get_nom_Adherent()."'></td></tr>
			<tr><td>Prenom </td><td><input type='text' name='prenom_Adherent' placeholder='prenom_Adherent' value='".$object->get_prenom_Adherent()."'></td></tr>
			
<tr><td><label for='Club'>Club</label><br /></td>
          <td>  <select name='nom_Club' id='nom_Club' required>";

          foreach ($rows2 as $Club) {
             if($Club->get_nom_Club()==$ji){
              echo ' <option selected value='.$Club->get_nom_Club().'>'.$Club->get_nom_Club().'</option>';
            }
         
			else   {
				 echo ' <option value='.$Club->get_nom_Club().'>'.$Club->get_nom_Club().'</option>';
			}  }       
               echo "</select></td></tr>


			<tr><td>
			  Date de naissance</td><td><input type='date' name='date_naissance' placeholder='date_naissance' value='".$object->get_date_naissance()."'></td></tr>


			
			<tr><td>Rue</td><td><input type='text' name='rue_Adherent' placeholder='rue_Adherent' value='".$object->get_rue_Adherent()."'></td></tr>

			<tr><td>CP </td><td><input type='text' name='cp_Adherent' placeholder='cp_Adherent' value='".$object->get_cp_Adherent()."'></td></tr>
			<tr><td>Ville</td><td><input type='text' name='ville_Adherent' placeholder='ville_Adherent' value='".$object->get_ville_Adherent()."'></td></tr>

			<tr><td><label for='sexe_Adherent'>sexe  Adherent</label><br /></td>
          <td>  <select name='sexe_Adherent' id='sexe_Adherent' required>";
          if ($object->get_sexe_Adherent()== "Homme"){
				echo "<option selected value='Homme'>Homme</option>
               <option value='Femme'>Femme</option>";

          }
          else {
          	echo "<option value='Homme'>Homme</option>
               <option selected value='Femme'>Femme</option>";
          }
            
               echo "</select></td></tr>
			<input type='hidden' name ='id_Adherent' value='".$id_Adherent."'>
			<tr><td><input type='submit' name='submit' value='Valider les modifications'></td>
		</table>
	</form>";


	if ($submit){
	$object->update($licence_Adherent,$nom_Adherent,$prenom_Adherent,$date_naissance,$rue_Adherent,$cp_Adherent,$ville_Adherent,$sexe_Adherent,$id_Adherent );
	header('Location: ../ProfilUtilisateur.php');
	}
?>
		</div>
	</div>
</div>