<?php

class FilmController{

    private $model;
    private $film;
    private $msg;
    private $display;
    private $details;
    


    public function __construct(){
        $this->model = new FilmModel();

    }

    public function manage($match){
        $this->msg = [];
        $table =[];
        $order = [];
        var_dump($match);

        if(isset($_GET['return'])){
            $_POST['research'] = $_GET['return'];
        }

        if(isset($_POST['research'])){
            $_POST['research'] = str_replace(' ', '+', $_POST['research']);
            if($_GET['page'] === 'form'){
                $type = 'search';
                $research = 'query=' . $_POST['research'];
            }elseif($_GET['page'] === 'film'){
                $type = 'discover';
                $research = 'sort_by=popularity.desc&year=' . $_POST['research'];
            }
            
            $this->request = $this->model->getFilmFromTMDB($type, $research);
            if($this->request === false){
                array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
            }elseif($this->request === NULL){
                array_push($this->msg, "<div class='notification is-warning'>Il n'y a aucun résultat pour cette recherche.</div>");
            }
        }

        if(isset($_GET['add'])){
            $add = $this->model->saveFilm($_GET['name'], NULL, NULL, NULL, NULL, NULL, $_GET['filed'], $_GET['img'], $_GET['tmdb'], $_GET['wish']);
            if($add === false){
                array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
            }else{
                array_push($this->msg, "<div class='notification is-success'>Le film à bien été ajouté.</div>");
            }
        }

        if(isset($_GET['detail']) && isset($_GET['tmdb'])){
            $this->details = $this->model->getDetailsFromTMDB($_GET['tmdb']);
        }

        if(isset($_GET['deleteFilm'])){
            $delete = $this->model->deleteFilm($_GET['deleteFilm']);

                if($delete === false){
                    array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
                }else{
                    array_push($this->msg, "<div class='notification is-success'>Le film à bien été supprimé.</div>");
                }
        }

        if(isset($_GET['watched'])){
            $table['movie_is_seeing'] = $_GET['watched'];
        }
        if(isset($_GET['id'])){
            $table['movie_id'] = $_GET['id'];
        }
        if(isset($_GET['filed'])){
            $table['movie_is_filing'] = $_GET['filed'];
        }
        if(isset($_GET['tmdb'])){
            $table['movie_tmdb_id'] = $_GET['tmdb'];
        }
        if(isset($_GET['wish'])){
            $table['movie_wish'] = $_GET['wish'];
        }
        if(isset($_GET['order']) && $_GET['order'] === 'mark'){
            $order = ['field' => 'movie_mark', 'type'=> $_GET['value']];
        }elseif(isset($_GET['order']) && $_GET['order'] === 'name'){
            $order = ['field' => 'movie_name', 'type' => $_GET['value']];
        }elseif(isset($_GET['order']) && $_GET['order'] === 'year'){
            $order = ['field' => 'movie_year', 'type' => $_GET['value']];
        }
        
        $this->film = $this->model->getAllFilm('movie', $table, $order, 'category', 'id_category', 'category_id');
        if($this->film === false){
            array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
        }elseif(empty($this->film)){
            array_push($this->msg, "<div class='notification is-primary is-light'>Il n'y a aucun film à afficher.</div>");
        }

        if(isset($_GET['detail']) && $_GET['detail'] === "true"){
            if(!empty($this->film) && $this->film[0]['movie_is_seeing'] === 1){
                $this->film[0]['movie_is_seeing'] = 'Oui';
            }
            include __DIR__ . './../view/view_film_detail.php';
        }else{
            include __DIR__ . './../view/view_filmlist.php';
        }
    }
}

?>
