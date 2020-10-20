<?php

class CategoryController{
    
    private $display;
    private $msg;
    private $catgeory;
    private $deleteCategory;
    private $modifyCategory;
    private $addCategory;

    public function __construct(){
        $this->model = new CategoryModel();
    }

    public function manage(){
        $this->msg = [];


        if(isset($_GET['modifyCat']) && isset($_POST['nameCat'])){
            $this->modifyCategory = $this->model->modifyCategory($_POST['nameCat'], $_GET['modifyCat']);
            
            if($this->modifyCategory === false){
                array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
            }else{
                array_push($this->msg, "<div class='notification is-succes'>La catégorie à bien été modifiée.</div>");  
            }
        }

        if(!isset($_GET['modifyCat']) && isset($_POST['nameCat'])){
            $this->addCategory = $this->model->addCategory($_POST['nameCat']);
            
            if($this->addCategory === false){
                array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
            }else{
                array_push($this->msg, "<div class='notification is-succes'>La catégorie à bien été ajoutée.</div>");  
            }
        }

        if(isset($_GET['delete_category'])){
            $this->deleteCategory = $this->model->deleteCategory($_GET['delete_category']);
            
            if($this->deleteCategory === false){
                array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
            }else{
                array_push($this->msg, "<div class='notification is-succes'>La catégorie à bien été supprimée.</div>");  
            }
            
            
        }

        $this->category = $this->model->getAllCategory();
        
        if($this->category === false){
            array_push($this->msg, "<div class='notification is-warning'>Oups ! On dirait qu'un problème est survenu.</div>");
        }elseif(empty($this->category)){
            array_push($this->msg, "<div class='notification is-primary is-light'>Il n'y a aucune catégorie à afficher.</div>");
        }
        

        include __DIR__ . './../view/view_categories.php';
    }
}

?>
