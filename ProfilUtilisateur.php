<?php 

    session_start();
    include_once('Includes/AdherentDAO.php');
    include_once('Includes/Adherent.php');
    include_once('Includes/Club.php');
    //include_once('Includes/ClubDAO.php');

    $licence_adherent=isset($_POST['licence_adherent']) ? $_POST['licence_adherent'] : '';
    $id_Club=isset($_POST['id_Club']) ? $_POST['id_Club'] : '';
    $nom_adherent=isset($_POST['nom_adherent']) ? $_POST['nom_adherent'] : '';
    $prenom_adherent=isset($_POST['prenom_adherent']) ? $_POST['prenom_adherent'] : '';
    $date_naissance=isset($_POST['date_naissance']) ? $_POST['date_naissance'] : '';
    $ville_adherent=isset($_POST['ville_adherent']) ? $_POST['ville_adherent'] : '';
    $cp_adherent=isset($_POST['cp_adherent']) ? $_POST['cp_adherent'] : '';
    $rue_adherent=isset($_POST['rue_adherent']) ? $_POST['rue_adherent'] : '';
    $sexe_adherent=isset($_POST['sexe_adherent']) ? $_POST['sexe_adherent'] : '';
    
    $submit= isset($_POST['submit']);
  
    $tableau = array('licence_adherent' => $licence_adherent,'id_Club' => $id_Club,
    'nom_adherent' => $nom_adherent, 'prenom_adherent' => $prenom_adherent, 'date_naissance' => $date_naissance,'ville_adherent' => $ville_adherent,'cp_adherent' => $cp_adherent,'rue_adherent' => $rue_adherent,'sexe_adherent' => $sexe_adherent);
    if($submit) {
    $adherent_object = new adherent($tableau);
    $adherent_DAO = new adherentDAO();
    $adherent_DAO->insert_adherent($adherent_object, $_SESSION['pseudo_Demandeur']);
    }

    
    $adherents = new adherent();
    $rows = $adherents->findAllByPseudo($_SESSION['pseudo_Demandeur']); 
    $Clubs = new Club();
    $rows2 = $Clubs->findAll();
?>

<!DOCTYPE html>
<html>
<head>
<title>Fredi</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="Style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/cufon-yui.js"></script>
  <script type="text/javascript" src="js/arial.js"></script>
  <script type="text/javascript" src="js/cuf_run.js"></script>
</head>
<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="Index.php">Fredi</a></h1>

      </div>
        <?php
          include('Includes/MenuPrincipal.php');        ?>
               
      <div class="clr"></div>
    </div>
  </div>
  <div class="hbg">
    <div class="hbg_resize"> 
      <table border=1 cellspacing=1 cellpadding=2 bordercolor="black">

        <caption><h2>adherents de <?php echo $_SESSION['pseudo_Demandeur']; ?> </h2></caption>
        <tr>
       
            <th>N° de licence</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Club</th>
            <th>Ligue</th>
            <th>Date Naissance</th>
            <th>Adresse</th>
            <th>Code Postal</th>
            <th>Ville</th>
            <th>Sexe</th>
            <th>Modifier</th> 
            <th>Supprimer</th>             
        
        </tr>

            <?php 

              foreach ($rows as $adherents) {
                echo
                '<tr>
                    <td>'.$adherents->get_licence_adherent().'</td>
                    <td>'.$adherents->get_nom_adherent().'</td>
                    <td>'.$adherents->get_prenom_adherent().'</td>
                    <td>'.$adherents->get_nom_Club().'</td>
                    <td>'.$adherents->get_libelle_Ligue().'</td>
                    <td>'.$adherents->get_date_naissance().'</td>
                    <td>'.$adherents->get_rue_adherent().'</td>
                    <td>'.$adherents->get_cp_adherent().'</td>
                    <td>'.$adherents->get_ville_adherent().'</td>
                    <td>'.$adherents->get_sexe_adherent().'</td>
                    <td><a href="Includes/ModifierAdh.php?id_adherent='.$adherents->get_id_adherent().'&ji='.$adherents->get_nom_Club().'"><img src="Images/modif.jpg" width="60" height="60"></td>

                    <td><a href="Includes/supprimerAdh.php?id_adherent='.$adherents->get_id_adherent().'"><img src="Images/delete.png" width="60" height="60" style="position: center;"></a></td>
                </tr>'; 
                }

            ?>
      </table>          
            
    </div>
  </div>


<div class="content"> 
  <div class="content_resize">
    <h2> Entrez un adhérent que vous souhaitez gérer </h2>
      <form action="ProfilUtilisateur.php" method="post" name="FormAjoutAdh">
        <div class="form_Ins_Un">
          <p> Numéro de licence<br /><input type="text" name="licence_adherent" value=""  required/></p>


            <label for="Club">Club</label><br />
            <select name="id_Club" id="id_Club" required>
               
               
               
          

<?php 
            foreach ($rows2 as $Club) {
             
              echo '<option value='.$Club->get_id_Club().'>'.$Club->get_nom_Club().'</option>';
            }

          ?>
        
  </select>









          
          <p> Nom adherent<br /><input type="text" name="nom_adherent" value=""  required/></p>
          <p> Prenom adherent<br /><input type="text" name="prenom_adherent" value=""  required/></p>
          <p> Date de naissance<br /><input type='date' name='date_naissance' placeholder='date_naissance' required/></p>
        </div>
        <div class="form_Ins_Deux">
          <p> Ville adherent<br /><input type="text" name="ville_adherent" value=""  required/></p>
          <p> Code postal<br /><input type="text" name="cp_adherent" value=""  required/></p>
          <p> Rue adherent<br /><input type="text" name="rue_adherent" value=""  required/></p>
          <p>
            <label for="sexe_adherent">sexe_adherent</label><br />
            <select name="sexe_adherent" id="sexe_adherent" required>
               <option value=""> </option>
               <option value="Homme">Homme</option>
               <option value="Femme">Femme</option>
            </select>
          </p>
          <input type="hidden" name="id_Demandeur" value=<?php $adherents->get_id_Demandeur()?> />
          <input type="submit" name="submit" value="Ajouter"></br>
          </div>
      </form>


      
    <div class="clr"></div>
  </div>

  <?php
    include('Includes/Footer.php');  ?>
</div>
</body>
</html>