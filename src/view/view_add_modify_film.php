<?php
    include 'header.php';
?>
<section class="section">
    <form action="" method="post">
        <div class="field">
            <label class="label">Nom du film</label>
            <div class="control">
                <input class="input" type="text" name="research">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type ="submit" class="button is-primary">Trouver un film depuis TMDB</button>
            </div>
        </div>
    </form>
</section>

<?php
include'request_result.php';
?>
        


    

<section class="section">
    <form action="" method="post">
        <div class="field">
            <label class="label">Nom du film</label>
            <div class="control">
                <input class="input" type="text" name="name"
                <?php if(isset($this->film)){echo 'value="' . $this->film[0]['movie_name'] . '"';}?>
                >
            </div>
        </div>
        <div class="field">
            <label class="label">Année</label>
            <div class="control">
                <input class="input" type="text" name="year"
                <?php if(isset($this->film)){echo 'value="' . $this->film[0]['movie_year'] . '"';}?>
                >
            </div>
        </div>
        <div class="field">
            <label class="label">Durée</label>
            <div class="control">
                <input class="input" type="text" name="duration"
                <?php if(isset($this->film)){echo 'value="' . $this->film[0]['movie_duration'] . '"';}?>
                >
            </div>
        </div>
        <div class="field">
            <label class="label">Affiche du film</label>
            <div class="control">
                <input class="input" type="text" name="img" placeholder="Insérer une url"
                <?php if(isset($this->film)){echo 'value="' . $this->film[0]['movie_img'] . '"';}?>
                >
            </div>
        </div>
        <div class="field">
            <label class="label">Categorie</label>
            <div class="control">
                <div class="select">
                <select name="category">
                    <?php
                    if(!empty($this->category)){
                        foreach($this->category as $value){
                        ?>
                            <option value="<?= $value['category_id'] ?>"
                            <?php if(isset($this->film) && $this->film[0]['id_category'] == $value['category_id']){echo 'selected';} ?>
                            ><?= $value['category_name'] ?></option>
                        <?php
                        }
                    }
                    ?>
                    
                </select>
                </div>
            </div>
            </div>
            <div class="field">
                <div class="control">
                    <label class="checkbox">
                        <strong>Film vu</strong>
                        <input type="checkbox" name="see"
                        <?php if(isset($this->film) && $this->film[0]['movie_is_seeing'] == '1'){echo 'checked';} ?>
                        >
                    </label>
                </div>
            </div>
            <div class="field">
                <label class="label">Note</label>
                <div class="control">
                    <div class="select">
                        <select name="mark">
                            <option value='0'>Aucune note, sinon choisir</option>
                            <?php 
                            for($i = 1; $i < 6; $i++){
                            ?>
                                <option value='<?= $i; ?>' <?php if(isset($this->film) && $this->film[0]['movie_mark'] == $i){echo 'selected';} ?> > <?= $i ?></option>
                            <?php
                            }
                            ?>
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label">Commentaire</label>
                <div class="control">
                    <textarea class="textarea" name="comment"><?php if(isset($this->film)){echo $this->film[0]['movie_comment'];}?></textarea>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type ="submit" class="button is-primary">Enregistrer</button>
                </div>
            </div>
        
    </form>

</section>
<?php
    include 'footer.php';
?>
