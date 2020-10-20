<?php
include 'header.php';

if(!empty($this->details)){
?>
    <section class="section">
        <div class="columns">        
            <div class="column is-one-fifth"></div>
            <div class="column has-text-centered">
                <div class="columns is-multiline">
                    <div class="column is-full has-text-centered">
                        <h1 class="title is-1"><?= $this->details->title ?></h1>
                    </div>
                    <div class="column is-two-fifth has-text-centered">
                        <img src="https://image.tmdb.org/t/p/w500<?=$this->details->poster_path;?>" alt="" class="is-inline-block">
                    </div>                
                    <div class="column is-three-fifth has-text-centered">
                        <p class="title is-5">Date de réalisation : <?= $this->details->release_date ?></p>
                        <p class="title is-5">Résumé : <?= $this->details->overview ?></p>
                        <p class="title is-5">Catégorie : 
                            <?php 
                            foreach($this->details->genres as $key => $objet){
                                echo $objet->name;
                                if($key < count($this->details->genres) - 1){
                                    echo ', ';
                                }
                            }
        
                            ?>
                        </p>
                        <p class="title is-5">Note des internautes : <?= $this->details->vote_average ?> /10</p>
                        
                    </div>
                    <div class="column is-full has-text-centered">
                        <?php
                        if(empty($this->details->videos->results['0']->key)){
                            ?>
                            <p class="title is-5">Il n'y a pas de bande annonce pour ce film.</p>
                        <?php
                        }else{
                            ?>
                            <p class="title is-5">Bande annonce :</p>
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$this->details->videos->results['0']->key?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <?php
                        }
                        
                        ?>
                    </div>
                    <div class="column is-full has-text-centered">                        
                        <a href="?page=film&archived=<?= $this->film[0]['movie_id'] ?>" class="button is-warning is-light">Archiver</a>
                        <a href="?page=film&deleteFilm=<?= $this->film[0]['movie_id'] ?>" class="button is-danger is-light">Supprimer</a>
                    </div>   
                </div>
            </div>    
            <div class="column is-one-fifth"></div>
            
        </div>
    </section>
<?php
}else{
?>
    <section class="section">
        <div class="columns">
            <div class="column is-one-fifth"></div>
            <div class="column has-text-centered">
                <div class="columns is-multiline">
                    <div class="column is-full has-text-centered">
                        <h1 class="title is-1"><?= $this->film[0]['movie_name']; ?></h1>
                    </div>
                    <div class="column is-two-fifth has-text-centered">
                        <img src="<?= $this->film[0]['movie_img']; ?>" alt="" class="is-inline-block">
                    </div>
                    
                    <div class="column is-three-fifth has-text-centered">
                        <p class="title is-4">Catégorie : <?= $this->film[0]['category_name']; ?></p>
                        <p class="title is-4">Année : <?= $this->film[0]['movie_year']; ?></p>
                        <p class="title is-4">Durée : <?= $this->film[0]['movie_duration']; ?></p>
                        <p class="title is-4">Film vu : <?= $this->film[0]['movie_is_seeing']; ?></p>
                        <p class="title is-4">Note : <?= $this->film[0]['movie_mark']; ?></p>
                        <p class="title is-4">Commentaire : <?= $this->film[0]['movie_comment']; ?></p>
                    </div>
                    <div class="column is-full has-text-centered">
                        <a href="?page=form&modifyFilm=<?= $this->film[0]['movie_id'] ?>" class="button is-primary is-light">Modifier</a>
                        <a href="?page=film&archived=<?= $this->film[0]['movie_id'] ?>" class="button is-warning is-light">Archiver</a>
                        <a href="?page=film&deleteFilm=<?= $this->film[0]['movie_id'] ?>" class="button is-danger is-light">Supprimer</a>
                    </div>
                    
                </div>
            </div>    
            <div class="column is-one-fifth"></div>
            
        </div>
    </section>
    
<?php
}
include 'footer.php';
?>

