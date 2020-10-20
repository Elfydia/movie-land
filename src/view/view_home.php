<?php
    include 'header.php';
?>
<section class="section">
    <div class="box">
        <p>Pour commencer et être de bonne humeur, une petite blague sur notre ami Chuck Norris !!!</p>
        <?php
            $chuck = file_get_contents("https://api.chucknorris.io/jokes/random");
            
            $chuck = json_decode($chuck);
            
            echo $chuck->value;
        ?>
    </div>
</section>
<section class="section">
    <div class="columns is-multiline">
        <div class="column is-one-quarter"></div>
        <div class="column has-text-centered">
            <img src="src/public/img/home.jpg" alt="bobine-de-film" class="is-inline-block">
        </div>
        <div class="column is-one-quarter"></div>
        <div class="column is-full has-text-centered">
            <h1 class="title is-1">Movies Land</h1>
        </div>
    </div>
</section>
<?php
    include 'footer.php';
?>
