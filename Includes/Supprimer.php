<?php
session_start();
include_once "LigneFrais.php";
$id = $_GET['idBordereau'];
$annee =$_GET['annee'];


$adieu = new LigneFrais();
$bye = $adieu->delete($id);

header('Location: ../Bordereau.php?annee='.$annee.'');



?>