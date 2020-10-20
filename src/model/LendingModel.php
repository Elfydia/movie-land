<?php

class LendingModel{
    
    private $bdd;

    public function __construct() {
        $config = json_decode(
            file_get_contents(__DIR__."/../../config/" . ENV . "/db.json")
        );
        try {

            $this->bdd = new PDO($config->dsn,
                $config->user, $config->pswrd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            
        } catch (Exception $e) {

            var_dump('Echec lors de la tentative de connexion');
        }
    }

    public function getAllLending() {
        try {

            $request = $this->bdd->prepare('SELECT * FROM lending LEFT JOIN movie ON lending.id_movie = movie.movie_id');
            $request->execute(array());
            $lending = $request->fetchAll();

            return $lending;
        } catch (Exception $e){
            var_dump('ERROR category');
            return false;
        }
    }

    public function addLending($person, $date, $lending) {
        try {

            $request = $this->bdd->prepare('INSERT INTO lending (lending_person, lending_date, id_movie) VALUES (?, ?, ?)');
            $request->execute(array($person, $date, $lending));
            return true;
            
        } catch (Exception $e){
            var_dump('ERROR category');
            return false;
        }
    }

    public function deleteLending($id) {
        try {

            $request = $this->bdd->prepare('DELETE FROM lending WHERE lending_id = ? ');
            $request->execute(array($id));
            return true;
            
        } catch (Exception $e){
            var_dump('ERROR category');
            return false;
        }
    }
}
