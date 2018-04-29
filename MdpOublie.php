<?php 
    session_start();
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
    <div class="hbg_resize"> <img src="Images/motDePasse.jpg" width="446" height="280" alt="Image accueil" class="hbgimg" />
      <div><h2> Récupération </h2>
      	<p>Pseudo <br /><input type="text" name="pseudo" placeholder="jean-paul" required/></p>
		<p>adresse mail <br /><input type="text" name="mail" value="" placeholder="Viktorus@fredi.fr" required/></p>
		<input type="submit" name="submit" value="envoyer l'email de récuperation"></BR>

		<a href="Inscription.php">   Pas encore inscrit ?  </a></BR>
		<a href="Connexion.php"> Retour à la connexion </a>
      </p>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="content_resize">
      
      <h2> Informations </h2>
        <p> Notre service de remboursement n'est effectif que lorsque votre licence sportive est confirmée sur Toulouse. Cette licence doit faire partie des Ligues affiliées à notre service. </p>
    </div>    
    <div class="clr"></div>
  </div>


  <?php 
    include('Includes/Footer.php');  ?>
  
</div>
</body>
</html>
			