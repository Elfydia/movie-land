<?php
    include 'header.php';
?>
<section class='section has-text-centered'>
    <div class="is-inline-block">
        <form action="?page=category" method="post">
            <div class="field">
                <label class="label">Nom de la catégorie</label>
                <div class="control">
                    <input class="input" type="text" name="nameCat"
                    <?php
                    if(isset($_GET['modifyCat'])){
                        foreach($this->category as $value){
                            if($value['category_id'] === $_GET['modifyCat']){
                                echo 'value="' . $value['category_name'] . '"';
                            }
                        }
                        
                    }
                    ?>
                    >
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type="submit" class="is-outlined">
                        <?php
                        if(isset($_GET['modifyCat'])){
                            echo 'Valider la modification';
                        }else{
                            echo 'Ajouter la catégorie';
                        }
                        ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
<section class="section">
    <?php
    if(!empty($this->category)){
        foreach($this->category as $value){
        ?>
        <div class="box level">
            <div class="level-item">
                 <p><?= $value['category_name'] ?></p>
            </div>
            <div class="level-item">
                <a href="?page=category&modifyCat=<?= $value['category_id'] ?>" class="button is-primary is-outlined">Modifier</a>
            </div>   
            <div class="level-item">
                <a href="?page=category&delete_category=<?= $value['category_id'] ?>"  class="button is-danger is-outlined">
                    <span class="icon is-small">
                        <i class="fas fa-times"></i>
                    </span>
                </a>
            </div>
        </div>
        <?php
        }
    } 
    ?>
    
</section>
<?php
    include 'footer.php';
?>
