<?php
    include 'header.php';

if(isset($_GET['filed']) && $_GET['filed' ] == 0 && $_GET['wish'] == 0) {   
?>
    <section class="section box">
        <a href="?page=film&filed=0&wish=0" class="button is-primary is-focused is-rounded">Tous les films</a>
        <a href="?page=film&filed=0&wish=0&watched=0" class="button is-primary is-focused is-rounded">Uniquement les non vus</a>
        <a href="?page=film&filed=0&wish=0&watched=1" class="button is-primary is-focused is-rounded">Uniquement les vus</a>
        <a href="?page=film&filed=0&wish=0&order=mark&value=DESC" class="button is-primary is-focused is-rounded">Classés par note la plus grande</a>
        <a href="?page=film&filed=0&wish=0&order=name&value=ASC" class="button is-primary is-focused is-rounded">Classés de A à Z</a>
        <a href="?page=film&filed=0&wish=0&order=year&value=DESC" class="button is-primary is-focused is-rounded">Classés du plus récent au plus ancien</a>


    </section>

<?php
}
if(isset($_GET['wish']) && $_GET['wish'] == '1'){
    ?>
    <section class="section box">
        <form action="" method="post">
            <div class="field">
                <label class="label">Trouver de nouveaux films parmis les plus populaire classés par date :</label>
                <div class="control">
                    <div class="select">
                        <select name="research">
                            <?php
                            
                                for($i = 2020 ; $i > 1939 ; $i-- ){
                                ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php
                                }
                            
                            ?>
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type ="submit" class="button is-primary">Je lance la recherche !</button>
                </div>
            </div>
        </form>
    </section>

    
<?php
    include 'request_result.php';
}
?>

<section class="section">
    <div class="columns is-multiline">
        <?php
        if(!empty($this->film)){
            foreach($this->film as $value){
            ?>
            <div class="column is-one-quarter" itemscope itemtype="http://schema.org/Movie">
                <img src="
                <?php 
                    if($value['movie_tmdb_id'] !== NULL){
                        echo 'https://image.tmdb.org/t/p/w500';
                    } 
                    echo $value['movie_img'] ?>">
                <p itemprop="name"><?= $value['movie_name'] ?></p>
                <?php
                if($value['movie_is_filing'] == '1'){
                ?>
                    <a href="?page=film&id=<?= $value['movie_id'] ?>" class="button is-primary is-light">Retirer des archives</a>
                <?php
                
                }elseif($value['movie_tmdb_id'] !== NULL){
                    ?>
                    <a href="?page=film&detail=true&name=<?=$value['movie_name']?>&tmdb=<?=$value['movie_tmdb_id']?>&id=<?=$value['movie_id']?>" class="button is-primary is-light">Détails</a>
                <?php
                }else{
                ?>
                    <a href="?page=film&detail=true&id=<?=$value['movie_id'] ?>" class="button is-primary is-light">Détails</a>
                <?php
                }
                ?>
            </div>
            <?php
            }
        } 
        ?>
        
        
    </div>
</section>
<?php
    include 'footer.php';
?>
