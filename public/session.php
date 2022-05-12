<?php
session_start();
if (isset($_SESSION['email'])) {
    $id = $_SESSION['id'];
    $email = $_SESSION['email'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $mdp = $_SESSION['password'];
} else {
    header('location: index.php');
}