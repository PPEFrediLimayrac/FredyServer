<?php
session_start();
include_once "Adherent.php";

$id = $_GET['id_adherent'];

$adieu = new adherent();
$bye = $adieu->deleteAdh($id);

 header('Location: ../ProfilUtilisateur.php');



?>