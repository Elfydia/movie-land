<?php

class AddModifyFilmController{

    private $model;
    private $category;
    private $display;
    private $msg;
    private $filmModel;
    private $request;

    public function __construct(){
        $this->model = new CategoryModel();
        $this->filmModel = new FilmModel();

    }

    public function manage(){
        $this->msg = [];

        if(isset($_GET['return'])){
            $_POST['movieName'] = $_GET['return'];
        }
        if(isset($_GET['detail'])){
            $this->details = $this->filmModel->getDetailsFromTMDB($_GET['tmdb']);
        }
        if(isset($_POST['movieName'])){
            $_POST['movieName'] = str_replace(' ', '+', $_POST['movieName']);
            $this->request = $this->filmModel->getFilmFromTMDB($_POST['movieName']);
            if($this->request === false){
                array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
            }elseif($this->request === NULL){
                array_push($this->msg, "<div class='notification is-warning'>Il n'y a aucun résultat pour cette recherche.</div>");
            }
        }
        if(isset($_POST['name'])){
            if($_POST['name'] === '' || $_POST['year'] === '' || $_POST['duration'] === '' || $_POST['category'] === ''){
                $this->msg = "<div class='notification is-warning'>Tous les champs ne sont pas remplis. Merci de completer les informations</div>";
            }else{
                if($_POST['see'] !== false){
                    $_POST['see'] = '1';
                }else{
                    $_POST['see'] = '0';
                }
                                
                $this->saveFilm = $this->filmModel->saveFilm(
                    $_POST['name'],
                    $_POST['year'],
                    $_POST['comment'],
                    $_POST['duration'],
                    $_POST['mark'],
                    $_POST['category'],
                    $_POST['see'],
                    $_POST['img']

                );
                if($this->saveFilm === false){
                    array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
                }else{
                    array_push($this->msg, "<div class='notification is-success'>Le film à bien été sauvegardé.</div>");
                }

            }
        }
        
        if(isset($_GET['modifyFilm'])){
            $table =[];
            $order = [];

            $table['movie_id'] = $_GET['modifyFilm'];

            $this->film = $this->filmModel->getAllFilm('movie', $table, $order, 'category', 'id_category', 'category_id');
            
            if($this->film === false){
                array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
            }elseif(empty($this->film)){
                array_push($this->msg, "<div class='notification is-primary is-light'>Il n'y a aucun film à afficher.</div>");
            }
        }
        

        $this->category = $this->model->getAllCategory();

        if($this->category === false){
            array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
        }elseif(empty($this->category)){
            array_push($this->msg, "<div class='notification is-primary is-light'>Il n'y a aucune categorie.</div>");
        }

        include __DIR__ . './../view/view_add_modify_film.php';
    }
}

?>
