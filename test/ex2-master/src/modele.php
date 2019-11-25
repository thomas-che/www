<?php
    define("SERVER", "localhost");
    define("USER", "root");
    define("PASSWORD", "root");
    define("TABLE", "exo2");

    function getConnection(){
        $connexion = new PDO("mysql:dbname=" . TABLE . ";host=" . SERVER, USER, PASSWORD);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->query("SET NAMES UTF8");
        return $connexion;
    }

    function addClient($nom, $prenom, $numero, $date){
        $connexion = getConnection();
        $connexion->query("INSERT INTO client(nom, prenom, dateNaissance, numTel) VALUES('{$nom}', '{$prenom}', '{$date}', '{$numero}')");
    }

    function deleteClient($numero){
        $connexion = getConnection();
        $connexion->query("DELETE FROM client WHERE numTel = '{$numero}'");
    }

    function getAllClient(){
        $connexion = getConnection();
        $answer = $connexion->query("SELECT * FROM client");
        return $answer->fetchall();
    }

    function getClient($nom){
        $connexion = getConnection();
        $answer = $connexion->query("SELECT * FROM client WHERE nom = '{$nom}'");
        return $answer->fetchall();
    }