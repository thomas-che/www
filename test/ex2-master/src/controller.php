<?php
    require_once("modele.php");

    function getPage($clients=[]){
        require("view.php");
    }

    function flushClient($nom, $prenom, $date, $numero){
        addClient($nom, $prenom, $date, $numero);
        getPage();
    }

    function searchClient($nom){
        getPage(getClient($nom));

    }

    function delClient(){
        foreach($_POST as $numero => $delete){
            if($delete == "on"){
                deleteClient($numero);
            }
        }
        getPage();
    }

    function displayAllClient(){
        getPage(getAllClient());
    }