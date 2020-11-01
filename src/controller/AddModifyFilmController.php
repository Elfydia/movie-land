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

        if(filter_imput(INPUT_GET, 'return')){
            $_POST['movieName'] = filter_imput(INPUT_GET, 'return');
        }
        if(filter_imput(INPUT_GET, 'details')){
            $this->details = $this->filmModel->getDetailsFromTMDB(filter_imput(INPUT_GET, 'tmdb'));
        }
        if(filter_imput(INPUT_POST, 'movieName')){
            $_POST['movieName'] = str_replace(' ', '+', filter_imput(INPUT_POST, 'movieName'));
            $this->request = $this->filmModel->getFilmFromTMDB(filter_imput(INPUT_POST, 'movieName'));
            if($this->request === false){
                array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
            }elseif($this->request === NULL){
                array_push($this->msg, "<div class='notification is-warning'>Il n'y a aucun résultat pour cette recherche.</div>");
            }
        }
        if(filter_imput(INPUT_POST, 'name')){
            if(filter_imput(INPUT_POST, 'name') === '' || filter_imput(INPUT_POST, 'year') === '' || filter_imput(INPUT_POST, 'duration') === '' || filter_imput(INPUT_POST, 'category') === ''){
                $this->msg = "<div class='notification is-warning'>Tous les champs ne sont pas remplis. Merci de completer les informations</div>";
            }else{
                if(filter_imput(INPUT_POST, 'see') !== false){
                    $_POST['see'] = '1';
                }else{
                    $_POST['see'] = '0';
                }
                                
                $this->saveFilm = $this->filmModel->saveFilm(
                    filter_imput(INPUT_POST, 'name'),
                    filter_imput(INPUT_POST, 'year'),
                    filter_imput(INPUT_POST, 'comment'),
                    filter_imput(INPUT_POST, 'duration'),
                    filter_imput(INPUT_POST, 'mark'),
                    filter_imput(INPUT_POST, 'category'),
                    filter_imput(INPUT_POST, 'see'),
                    filter_imput(INPUT_POST, 'img')

                );
                if($this->saveFilm === false){
                    array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
                }else{
                    array_push($this->msg, "<div class='notification is-success'>Le film à bien été sauvegardé.</div>");
                }

            }
        }
        
        if(filter_imput(INPUT_GET, 'modifyFilm')){
            $table =[];
            $order = [];

            $table['movie_id'] = filter_imput(INPUT_GET, 'modifyFilm');

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
