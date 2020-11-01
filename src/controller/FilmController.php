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

        if(filter_imput(INPUT_GET, 'return')){
            $_POST['research'] = filter_imput(INPUT_GET, 'return');
        }

        if(filter_imput(INPUT_POST, 'research')){
            $_POST['research'] = str_replace(' ', '+', filter_imput(INPUT_POST, 'research'));
            if(filter_imput(INPUT_GET, 'page') === 'form'){
                $type = 'search';
                $research = 'query=' . filter_imput(INPUT_POST, 'research');
            }elseif(filter_imput(INPUT_GET, 'page') === 'film'){
                $type = 'discover';
                $research = 'sort_by=popularity.desc&year=' . filter_imput(INPUT_POST, 'research');
            }
            
            $this->request = $this->model->getFilmFromTMDB($type, $research);
            if($this->request === false){
                array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
            }elseif($this->request === NULL){
                array_push($this->msg, "<div class='notification is-warning'>Il n'y a aucun résultat pour cette recherche.</div>");
            }
        }

        if(filter_imput(INPUT_GET, 'add')){
            $add = $this->model->saveFilm(filter_imput(INPUT_GET, 'name'), NULL, NULL, NULL, NULL, NULL, filter_imput(INPUT_GET, 'filed'), filter_imput(INPUT_GET, 'img'), filter_imput(INPUT_GET, 'tmdb'), filter_imput(INPUT_GET, 'wish'));
            if($add === false){
                array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
            }else{
                array_push($this->msg, "<div class='notification is-success'>Le film à bien été ajouté.</div>");
            }
        }

        if(filter_imput(INPUT_GET, 'detail') && filter_imput(INPUT_GET, 'tmdb')){
            $this->details = $this->model->getDetailsFromTMDB(filter_imput(INPUT_GET, 'tmdb'));
        }

        if(filter_imput(INPUT_GET, 'deleteFilm')){
            $delete = $this->model->deleteFilm(filter_imput(INPUT_GET, 'deleteFilm'));

                if($delete === false){
                    array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
                }else{
                    array_push($this->msg, "<div class='notification is-success'>Le film à bien été supprimé.</div>");
                }
        }

        // $array = ['watched', 'id']...

        if(filter_imput(INPUT_GET, 'watched')){
            $table['movie_is_seeing'] = filter_imput(INPUT_GET, 'watched');
        }
        if(filter_imput(INPUT_GET, 'id')){
            $table['movie_id'] = filter_imput(INPUT_GET, 'id');
        }
        if(filter_imput(INPUT_GET, 'filed')){
            $table['movie_is_filing'] = filter_imput(INPUT_GET, 'filed');
        }
        if(filter_imput(INPUT_GET, 'tmdb')){
            $table['movie_tmdb_id'] = filter_imput(INPUT_GET, 'tmdb');
        }
        if(filter_imput(INPUT_GET, 'wish')){
            $table['movie_wish'] = filter_imput(INPUT_GET, 'wish');
        }
        if(filter_imput(INPUT_GET, 'order') && filter_imput(INPUT_GET, 'order') === 'mark'){
            $order = ['field' => 'movie_mark', 'type'=> filter_imput(INPUT_GET, 'value')];
        }elseif(filter_imput(INPUT_GET, 'order') && filter_imput(INPUT_GET, 'order') === 'name'){
            $order = ['field' => 'movie_name', 'type' => filter_imput(INPUT_GET, 'value')];
        }elseif(filter_imput(INPUT_GET, 'order') && filter_imput(INPUT_GET, 'order') === 'year'){
            $order = ['field' => 'movie_year', 'type' => filter_imput(INPUT_GET, 'value')];
        }
        
        $this->film = $this->model->getAllFilm('movie', $table, $order, 'category', 'id_category', 'category_id');
        if($this->film === false){
            array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
        }elseif(empty($this->film)){
            array_push($this->msg, "<div class='notification is-primary is-light'>Il n'y a aucun film à afficher.</div>");
        }

        if(filter_imput(INPUT_GET, 'detail') && filter_imput(INPUT_GET, 'detail') === "true"){
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
