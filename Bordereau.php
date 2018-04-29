
<?php
  session_start();
  include_once "Includes\NoteDeFrais.php";
  include_once "Includes\LigneFrais.php";
  include_once "Includes\bloque.php";
  include_once "Includes\Indemnite.php";
  include_once "Includes\Adherent.php";

  $submit = isset($_POST['submit']) ? $_POST['submit'] : '';
  $LigneFrais = new LigneFrais();
 $Adherents = new Adherent();
    $adh = $Adherents->findAllByPseudo($_SESSION['pseudo_Demandeur']); 

  if($submit)
  {
    $annee= $_POST['annee'] ? $_POST['annee'] : '';
  }
  if(isset($_GET['annee']))
  {
    $annee=$_GET['annee'];
  }
  if(empty($annee)) {
    $annee = date("Y");
  }



  $valider =  isset($_POST['validerr']) ? $_POST['validerr'] : '';
  $pro = new bloque();
  $rows = $LigneFrais->findAllBy($_SESSION['pseudo_Demandeur'],$annee);

  if(!empty($valider)){
    
    $pro->insert($_SESSION['pseudo_Demandeur'],$annee);

  }
  $pros = $pro->findAllBy($_SESSION['pseudo_Demandeur'],$annee);


//  $Indemnite = new Indemnite();
//  $tarifKm = $Indemnite->findByID($LigneFrais->get_id_Indemnite());
//  $tarifKm = $Indemnite->get_tarif_kilometrique();
 // var_dump($tarifKm);
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
               
      <div class="clr">
        
      </div>
    </div>
    
  </div>
  <div class="hbg">
    <div class="hbg_resize"> 
      <div class="form_Ins_Un">
        <center>
          <?php echo '
        <form method="post" action="Bordereau.php">
          <SELECT name="annee" size="1">' ;

          
          if($annee == '2014'){
            echo ' <OPTION selected>2014';
          }else {echo ' <OPTION>2014';}
          if($annee == '2015'){
            echo ' <OPTION selected>2015';
          }else {echo ' <OPTION>2015';}
          if($annee == '2016'){
            echo ' <OPTION selected>2016';
          }else {echo ' <OPTION>2016';}
          if($annee == '2017'){
            echo ' <OPTION selected>2017';
          }else {echo ' <OPTION>2017';}
          if($annee == '2018'){
            echo ' <OPTION selected>2018';
          }else {echo ' <OPTION>2018';}





        echo  '</SELECT>
          <input type="submit" name="submit" value="Choisir cette année">
        </FORM>';

        ?>
      </center> 
   

        <table border=1 cellspacing=1 cellpadding=2 bordercolor="black">
            <caption><h1>Tableau des notes de frais </h1></caption>
            <tr>
             
              <th>Date</th>
              <th>Prénom adhérent</th>
              <th>Trajet</th>   
              <th>Kms parcourus</th>
              <th>Coût Trajet</th>
              <th>Péages</th>
              <th>Repas</th>
              <th>Hebergement</th>
              <th>Total</th>
             <?php if(empty($pros['id_bloque']))
             {
            echo "  <th>Modifier</th> 
              <th>Supprimer</th> "; }
              ?>           
            </tr>
            <?php 

             $tarifK = new Indemnite();
             $tarifKm = $tarifK->findByAnnee($annee);

              foreach ($rows as $LigneFrais) 
              {
               // $abcd = $LigneFrais->get_id_frais();
                $total =($LigneFrais->get_km_frais()*$tarifKm['tarif_kilometrique'])+$LigneFrais ->get_cout_trajet()+$LigneFrais->get_cout_peage()+$LigneFrais->get_cout_repas()+$LigneFrais->get_cout_hebergement();

                if(empty($pros['id_bloque']) )
                {  
                  echo('<tr>

                  
                  <td>'.$LigneFrais->get_dateLigneFrais().'</td>
                  <td>'.$LigneFrais->get_Adherent().'</td>
                  <td>'.$LigneFrais->get_trajet_frais().'</td>
                  <td>'.$LigneFrais->get_km_frais().'</td>
                  <td>'.$LigneFrais->get_km_frais()*$tarifKm['tarif_kilometrique'].'</td>
                  <td>'.$LigneFrais->get_cout_peage().'</td>
                  <td>'.$LigneFrais->get_cout_repas().'</td>
                  <td>'.$LigneFrais->get_cout_hebergement().'</td>

                    <td>'.$total.'</td>
                  <td><a href="Includes/Modifier.php?idBordereau='.$LigneFrais->get_id_frais().'&annee='.$annee.'"><img src="Images/modif.jpg" width="60" height="60"></td>
                  <td><a href="Includes/Supprimer.php?idBordereau='.$LigneFrais->get_id_frais().'&annee='.$annee.'"><img src="Images/delete.png" width="60" height="60" style="positio
                  n: center;"></a></td>
                  </tr>');   
                }else
                {
                  echo('<tr>
                      
                      <td>'.$LigneFrais->get_dateLigneFrais().'</td>
                      <td>'.$LigneFrais->get_Adherent().'</td>
                      <td>'.$LigneFrais->get_trajet_frais().'</td>
                      <td>'.$LigneFrais->get_km_frais().'</td>
                      <td>'.$LigneFrais->get_km_frais()*$tarifKm['tarif_kilometrique'].'</td>
                      <td>'.$LigneFrais->get_cout_peage().'</td>
                      <td>'.$LigneFrais->get_cout_repas().'</td>
                      <td>'.$LigneFrais->get_cout_hebergement().'</td>
                      <td>'.$total.'</td>
                   
                    </tr>');
                }
              }
            ?>
        </table> 
      <?php 
        if(empty($pros['id_bloque']))
        { 

            echo '<p><a href="Includes/Ajouter.php?idBordereau='.$LigneFrais->get_id_NoteDeFrais().'&annee='.$annee.'"><img src="Images/ajout.png" width="60" height="60"></a></p>';
            echo '<form method="post" action="Bordereau.php?annee='.$annee.'">
            <input type="submit" name="validerr" value="valider le bordereau">
            </form>';
        }
      ?>
      <div class="clr"></div>
    </div> 
  </div>
  
  <div class="content">
    <div class="content_resize">
      </br>
    </div>    
    <div class="clr"></div>
  </div>

  <?php
    include('Includes/Footer.php');  ?>
  </div>

</body>
</html> 
