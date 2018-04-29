 <?php

require('Includes/fpdf/fpdf.php');
require('Includes/NoteDeFrais.php');
require('Includes/Demandeur.php');
require('Includes/Adherent.php');

 function frais_pdf($Id_Demandeur, $Id_NoteDeFrais) {
    
    
    function c($string) {
      return iconv('UTF-8', 'windows-1252', $string);
    }
    $DemandeurDAO = new DemandeurDAO();
    $Demandeur = $DemandeurDAO->find($Id_Demandeur);

    foreach ($Demandeur->get_les_notes() as $note) { 
          if ($note->get_Id_NoteDeFrais() == $Id_NoteDeFrais) {
            $NoteDeFrais = $note;
          }
        }
    $Annee = $NoteDeFrais->get_les_lignes()[0]->get_Annee();
    $IndemniteDAO = new IndemniteDAO();
    $Indemnite = $IndemniteDAO->find($Annee);

    $pdf = new MyFPDF();
    $pdf->AddPage();
    $pdf->setTitle('Note de frais');
    $border = 0;
    $pdf->SetMargins(10, 10, 10, 10);

   
    $pdf->SetFont ('Arial', 'B', 15);
    $pdf->Cell(70, 10, c("Note de frais des bénévoles"), $border, 1, 'C');
    $pdf->Cell(300, -10, c("Année civile : ". $NoteDeFrais->get_les_lignes()[0]->get_Annee()), $border, 1, 'C');
    $pdf->SetFont ('Arial', 'B', 11);
  
    if ($Demandeur->get_isRepresentant() == true) {
      $Representant = $Demandeur->get_Representant();

      $pdf->Cell(28, 35, c("Je sousigné(e)"), $border, 1, 'L');
      $pdf->SetFont ('Arial', '', 11);

      $pdf->ln(-13);
      $pdf->Cell(190, 7, c($Representant->get_Nom().' '.$Representant->get_Prenom()), 1, 1, 'C');
      $pdf->ln(-13);

      $pdf->SetFont ('Arial', 'B', 11);
      $pdf->Cell(21, 35, c("Demeurant"), $border, 1, 'L');
      $pdf->SetFont ('Arial', '', 11);

      $pdf->ln(-13);
      $pdf->Cell(190, 7, c($Representant->get_rue().' '.$Representant->get_cp().' '.$Representant->get_ville()), 1, 1, 'C');
      $pdf->ln(-13);

      $pdf->SetFont ('Arial', 'B', 11);
      $pdf->Cell(10, 35, c("Certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association"), $border, 1, 'L');
      $pdf->SetFont ('Arial', '', 11);
      $trouver = false;
      $Nom = array();
      $Nom[0] = "";
     
      $pdf->ln(-13);

      foreach ($Representant->get_les_Adherents() as $Adherent){
        foreach ($Nom as $nom ) {
          if($Adherent->get_Club()->get_Nom() == $nom){
            $trouver = true;
          }
        }       
        if($trouver == false){

          $pdf->ln(0);
          $pdf->Cell(190, 7, c($Adherent->get_Club()->get_Nom().' '.$Adherent->get_Club()->get_AdresseClub().' '.$Adherent->get_Club()->get_Cp().' '.$Adherent->get_Club()->get_Ville()), 1, 1, 'C');
          $pdf->ln(0);

        }
        $Nom[] = $Adherent->get_Club()->get_Nom();
        $trouver = false;
      }

      $pdf->SetFont ('Arial', 'B', 11);
      $pdf->Cell(21, 8, c("en tant que don."), $border, 1, 'L');
      $pdf->SetFont ('Arial', 'B', 11);
      $pdf->Cell(30, 14, c("Frais de deplacement"), $border, 0, 'L');
      $pdf->SetFont ('Arial', '', 11);
      $pdf->SetFont('Arial', '', 9);
      $header = array('Date', 'Motif', 'Trajet', 'Kilomètre','Cout trajet',c('Péages'),'Repas',c('Hébergement'),'Total');
      $lignes = $NoteDeFrais->get_les_lignes();
      $totalT=$pdf->ImprovedTable($header, $lignes,$Indemnite);
      $pdf->SetFont ('Arial', 'B', 11);
      $pdf->Cell(30, 14, c("Je suis le représentant légal des adhérents suivants :"), $border, 0, 'L');
      $pdf->Ln();
      $pdf->SetFont ('Arial', '', 11);
      foreach ($Representant->get_les_Adherents() as $Adherent){
        $pdf->ln(0);
      $pdf->Cell(190, 7, c($Adherent->get_Nom().' '.$Adherent->get_Prenom().' licence n° '.$Adherent->get_numLicence()), 1, 1, 'C');
      $pdf->ln(0);
      }
      $pdf->SetFont ('Arial', 'B', 11);
      $pdf->Cell(30, 14, c("Montant total des dons : ".$totalT), $border,0, 'L');
      $pdf->SetFont ('Arial', 'I', 9);
      $pdf->Ln(7);
      $pdf->Cell(30, 14, c("Pour bénéficier du reçu de dons, cette note de frais doit être accompagnée de tous les justificatifs correspondants."), $border, 0, 'L');
      $pdf->Ln(7);
      $pdf->SetFont ('Arial', 'B', 11);
      $pdf->Cell(30, 17, c("A"), $border,0, 'L');
      $pdf->Cell(45, 17, c("Le"), $border,1, 'C');
      $pdf->Cell(30, 14, c("Signature du bénévole :"), $border,1, 'L');
      $pdf->ln(7);
      $width = 100;
      $height = 15;
      $pdf->setX(11);
      $y = $pdf->getY(50);
      $pdf->SetFont ('Arial', 'B', 11);
      $pdf->Cell(74,8, c("Partie réservé à l'association"), $border,1, 'R');
      $pdf->SetFont ('Arial', '', 11);
      $pdf->MultiCell($width,7, c("N° ordre de reçu : ".$NoteDeFrais->get_les_lignes()[0]->get_Annee().' - '.$NoteDeFrais->get_Id_NoteDeFrais()."\nRemis le :\nSignature du trésorier :\n\n\n"),1);
      $pdf->setY($y + $height);
    }
    
  $pdf->Output();
}
?>