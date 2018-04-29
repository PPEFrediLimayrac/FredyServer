<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Fredi</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="Style.css" rel="stylesheet" type="text/css"/>
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
      <h2> Bienvenue <?php echo $_SESSION['pseudo_Demandeur']; ?></h2>
        <div class="hbg_pos_center">
          <a class="buttonTempo" href="ProfilUtilisateur.php"><input type="button" name="ProfilUtilisateur" class="buttonTempo">Gestion de profil</a>
          </br>
          <a class="buttonTempo" href="bordereau.php"><input type="button" name="ProfilUtilisateur" class="buttonTempo">Accéder au Bordereau de frais</a>
        </div>
    </div>
  </div>
  <div class="content">
     
    <div class="clr"></div>
  </div>


  <?php 
    include('Includes/Footer.php');  ?>
  
</div>
</body>
</html>