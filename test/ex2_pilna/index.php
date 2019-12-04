<?php
    require_once("src/controller.php");

    if(isset($_POST["displayAllClient"])){
        displayAllClient();
    } elseif(isset($_POST["addClient"])){
        flushClient($_POST["nom"], $_POST["prenom"], $_POST["numtel"], $_POST["date"]);
    } elseif(isset($_POST["deleteClient"])){
        delClient($_POST);
    } elseif(isset($_POST["searchClient"])){
        searchClient($_POST["nom"]);
    } else {
        getPage();
    }