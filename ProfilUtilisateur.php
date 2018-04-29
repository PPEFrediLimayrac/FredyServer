<?php 

    session_start();
    include_once('Includes/AdherentDAO.php');
    include_once('Includes/Adherent.php');
    include_once('Includes/Club.php');
    //include_once('Includes/ClubDAO.php');

    $licence_Adherent=isset($_POST['licence_Adherent']) ? $_POST['licence_Adherent'] : '';
    $id_Club=isset($_POST['id_Club']) ? $_POST['id_Club'] : '';
    $nom_Adherent=isset($_POST['nom_Adherent']) ? $_POST['nom_Adherent'] : '';
    $prenom_Adherent=isset($_POST['prenom_Adherent']) ? $_POST['prenom_Adherent'] : '';
    $date_naissance=isset($_POST['date_naissance']) ? $_POST['date_naissance'] : '';
    $ville_Adherent=isset($_POST['ville_Adherent']) ? $_POST['ville_Adherent'] : '';
    $cp_Adherent=isset($_POST['cp_Adherent']) ? $_POST['cp_Adherent'] : '';
    $rue_Adherent=isset($_POST['rue_Adherent']) ? $_POST['rue_Adherent'] : '';
    $sexe_Adherent=isset($_POST['sexe_Adherent']) ? $_POST['sexe_Adherent'] : '';
    
    $submit= isset($_POST['submit']);
  
    $tableau = array('licence_Adherent' => $licence_Adherent,'id_Club' => $id_Club,
    'nom_Adherent' => $nom_Adherent, 'prenom_Adherent' => $prenom_Adherent, 'date_naissance' => $date_naissance,'ville_Adherent' => $ville_Adherent,'cp_Adherent' => $cp_Adherent,'rue_Adherent' => $rue_Adherent,'sexe_Adherent' => $sexe_Adherent);
    if($submit) {
    $Adherent_object = new Adherent($tableau);
    $Adherent_DAO = new AdherentDAO();
    $Adherent_DAO->insert_Adherent($Adherent_object, $_SESSION['pseudo_Demandeur']);
    }

    
    $Adherents = new Adherent();
    $rows = $Adherents->findAllByPseudo($_SESSION['pseudo_Demandeur']); 
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

        <caption><h2>Adherents de <?php echo $_SESSION['pseudo_Demandeur']; ?> </h2></caption>
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

              foreach ($rows as $Adherents) {
                echo
                '<tr>
                    <td>'.$Adherents->get_licence_Adherent().'</td>
                    <td>'.$Adherents->get_nom_Adherent().'</td>
                    <td>'.$Adherents->get_prenom_Adherent().'</td>
                    <td>'.$Adherents->get_nom_Club().'</td>
                    <td>'.$Adherents->get_libelle_Ligue().'</td>
                    <td>'.$Adherents->get_date_naissance().'</td>
                    <td>'.$Adherents->get_rue_Adherent().'</td>
                    <td>'.$Adherents->get_cp_Adherent().'</td>
                    <td>'.$Adherents->get_ville_Adherent().'</td>
                    <td>'.$Adherents->get_sexe_Adherent().'</td>
                    <td><a href="Includes/ModifierAdh.php?id_Adherent='.$Adherents->get_id_Adherent().'&ji='.$Adherents->get_nom_Club().'"><img src="Images/modif.jpg" width="60" height="60"></td>

                    <td><a href="Includes/supprimerAdh.php?id_Adherent='.$Adherents->get_id_Adherent().'"><img src="Images/delete.png" width="60" height="60" style="position: center;"></a></td>
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
          <p> Numéro de licence<br /><input type="text" name="licence_Adherent" value=""  required/></p>


            <label for="Club">Club</label><br />
            <select name="id_Club" id="id_Club" required>
               
               
               
          

<?php 
            foreach ($rows2 as $Club) {
             
              echo '<option value='.$Club->get_id_Club().'>'.$Club->get_nom_Club().'</option>';
            }

          ?>
        
  </select>









          
          <p> Nom Adherent<br /><input type="text" name="nom_Adherent" value=""  required/></p>
          <p> Prenom Adherent<br /><input type="text" name="prenom_Adherent" value=""  required/></p>
          <p> Date de naissance<br /><input type='date' name='date_naissance' placeholder='date_naissance' required/></p>
        </div>
        <div class="form_Ins_Deux">
          <p> Ville Adherent<br /><input type="text" name="ville_Adherent" value=""  required/></p>
          <p> Code postal<br /><input type="text" name="cp_Adherent" value=""  required/></p>
          <p> Rue Adherent<br /><input type="text" name="rue_Adherent" value=""  required/></p>
          <p>
            <label for="sexe_Adherent">sexe_Adherent</label><br />
            <select name="sexe_Adherent" id="sexe_Adherent" required>
               <option value=""> </option>
               <option value="Homme">Homme</option>
               <option value="Femme">Femme</option>
            </select>
          </p>
          <input type="hidden" name="id_Demandeur" value=<?php $Adherents->get_id_Demandeur()?> />
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