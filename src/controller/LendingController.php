<?php

class LendingController{

    private $model;
    private $msgLending;
    
    public function __construct(){
        $this->model = new LendingModel();
        $this->filmModel = new FilmModel();
    }

    public function manage(){
        $this->msg = [];
        $table =[];
        $order = [];

        if(isset($_POST['person'])){
            if($_POST['person'] === '' || $_POST['date'] === '' || $_POST['lending'] === ''){
                array_push($this->msg, "<div class='notification is-warning'>Tous les champs en sont pas remplis.</div>");
            }else{
                $this->save = $this->model->addLending($_POST['person'], $_POST['date'], $_POST['lending']);

                if($this->save === false){
                    array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
                }else{
                    array_push($this->msg, "<div class='notification is-success'>Le prêt à bien été sauvegardé.</div>");
                }
            }
        }

        if(isset($_GET['deleteLending'])){
            $this->delete = $this->model->deleteLending($_GET['deleteLending']);

                if($this->delete === false){
                    array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
                }else{
                    array_push($this->msg, "<div class='notification is-success'>Le prêt à bien été supprimé.</div>");
                }
        }

        $this->film = $this->filmModel->getAllFilm('movie', $table, $order, 'category', 'id_category', 'category_id');
        
        if($this->film === false){
            array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
        }elseif(empty($this->film)){
            $this->msgFilm = "<div class='notification is-warning is-light'>Il n'y a aucun film dans votre bibliothèque</div>";
        }

        $this->lending = $this->model->getAllLending();
        
        if($this->lending === false){
            array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
        }elseif(empty($this->lending)){
            $this->msgLending = "<div class='notification is-primary is-light'>Il n'y a aucun prêt pour le moment.</div>";
        }

        include __DIR__ . './../view/view_lending.php';
    }
}

?>