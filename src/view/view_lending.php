<?php
    include 'header.php';
?>
<section class="section">
    <form action="" method="post">
        <div class="field">
            <label class="label">Nom et prénom de l'emprunteur</label>
            <div class="control">
                <input class="input" type="text" name="person">
            </div>
        </div>
        <div class="field">
            <label class="label">Date du prêt</label>
            <div class="control">
                <input class="input" type="date" name="date">
            </div>
        </div>
        <div class="field">
            <label class="label">Selectionnez le film prêté</label>
            <div class="control">
                <div class="select">
                    <select name="lending">
                        <?php
                        if(!empty($this->film)){
                            foreach($this->film as $value){
                                ?>
                                <option value="<?= $value['movie_id'];?>"><?= $value['movie_name'];?></option>
                            <?php
                            }
                            ?>
                            </select>
                        <?php
                        }else{
                            echo $this->msgFilm;
                        }
                        ?>
                    
                </div>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type ="submit" class="button is-primary">Enregistrer</button>
            </div>
        </div>
    </form>

</section>
<section class="section">
    <?php
    if(!empty($this->lending)){
        foreach($this->lending as $value){
            ?>
            <div class="box">
                <p>Prêt à : <?= $value['lending_person'] ?></p>
                <p>Film : <?= $value['movie_name'] ?></p>
                <p>le : <?= $value['lending_date'] ?></p>
                <a href="?page=lending&deleteLending=<?= $value['lending_id'] ?>"  class="button is-danger is-outlined">
                    Le film est rendu
                </a>
            </div>
        <?php
        }
    }elseif(!empty($this->msgLending)){
        echo $this->msgLending;
    }
    ?>
</section>
<?php
    include 'footer.php';
?>
