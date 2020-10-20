<?php
if(isset($this->request)){
?>
    <section class="section">
        <div class="columns is-multiline">
            <?php
            foreach($this->request->results as $value){
            ?>
            <div class="column is-one-quarter">
                <img src="https://image.tmdb.org/t/p/w500/<?=$value->poster_path;?>">
                <p><?= $value->title ?></p>
                <a href="?page=<?php
                    if($_GET['page'] === 'form'){
                        echo 'form';
                    }elseif($_GET['page'] === 'film'){
                        echo 'film';
                    }
                ?>&detail=true&research=<?= $_POST['research'] ?>&tmdb=<?= $value->id ?>" class="button is-primary is-light">Détails</a>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
<?php
} 


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
                            if($key < count($this->details->genres)){
                                echo ',';
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
                    <a href="?page=<?php
                        if($_GET['page'] === 'form'){
                            echo 'form';
                        }elseif($_GET['page'] === 'film'){
                            echo 'film';
                        }
                    ?>&return=<?= $_GET['research']?>" class="button is-primary is-light">Retour aux résultats</a>
                    <a href="?page=film&add=true&filed=0&wish=0&tmdb=<?= $this->details->id?>&name=<?=$this->details->title?>&img=<?= $this->details->poster_path?>" class="button is-primary is-light">Ajouter à mes films</a>
                    <a href="?page=film&add=true&filed=0&wish=1&tmdb=<?= $this->details->id?>&name=<?=$this->details->title?>&img=<?= $this->details->poster_path?>" class="button is-primary is-light">Ajouter à ma liste d'envies</a>
                </div>   
            </div>
        </div>    
        <div class="column is-one-fifth"></div>
        
    </div>
</section>
<?php
}
?>