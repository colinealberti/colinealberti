<?php
session_start();
//Si c'est le premier passage sur une page du site, créer le "panier"
//le panier est un tableau contenant l'id en bd de l'article ajouté au panier
if(!isset($_SESSION['panier'])){
    $_SESSION['panier']= [];
}


