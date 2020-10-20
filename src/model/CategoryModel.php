<?php

class CategoryModel{

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

    public function getAllCategory() {
        try {

            $request = $this->bdd->prepare('SELECT * FROM category');
            $request->execute(array());
            $category = $request->fetchAll();

            return $category;
        } catch (Exception $e){
            var_dump('ERROR category');
            return false;
        }
    }

    public function deleteCategory($id) {
        try {

            $request = $this->bdd->prepare('DELETE FROM category WHERE category_id = ?');
            $request->execute(array($id));
            return true;
            
        } catch (Exception $e){
            var_dump('ERROR category');
            return false;
        }
    }

    public function modifyCategory($name, $id) {
        try {

            $request = $this->bdd->prepare('UPDATE category SET category_name = ? WHERE category_id = ?');
            $request->execute(array($name, $id));
            return true;
            
        } catch (Exception $e){
            var_dump('ERROR category');
            return false;
        }
    }

    public function addCategory($name) {
        try {

            $request = $this->bdd->prepare('INSERT INTO category (category_name) VALUES (?)');
            $request->execute(array($name));
            return true;
            
        } catch (Exception $e){
            var_dump('ERROR category');
            return false;
        }
    }
}

?>
