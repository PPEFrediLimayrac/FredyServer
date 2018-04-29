<?php
session_start();
include_once "Adherent.php";

$id = $_GET['id_Adherent'];

$adieu = new Adherent();
$bye = $adieu->deleteAdh($id);

 header('Location: ../ProfilUtilisateur.php');



?>