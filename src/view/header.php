<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="google-site-verification: googleb315efc55d9612ea.html" />
    <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="section has-background-primary">
            <nav class="level ">
                <div class="level-left">        
                    <p class="level-item">
                        <a href="?page=home" class="has-text-white" rel="nofollow">Home</a>
                    </p>
                    <p class="level-item">
                        <a href="?page=film&filed=0&wish=0" class="has-text-white">Mes Films</a>
                    </p>
                    <p class="level-item">
                        <a href="?page=form" class="has-text-white">Ajouter un film</a>
                    </p>
                    <p class="level-item">
                        <a href="?page=category" class="has-text-white">Catégories</a>
                    </p>
                    <p class="level-item">
                        <a href="?page=film&filed=1&wish=0" class="has-text-white">Archives</a>
                    </p>
                    <p class="level-item">
                        <a href="?page=lending" class="has-text-white">Prêts</a>
                    </p>
                    <p class="level-item">
                        <a href="?page=film&filed=0&wish=1" class="has-text-white">Liste des envies</a>
                    </p>
                </div>
            
            </nav>
        </div>
       
               
            
        
    </header>

    <main>
        <?php
        if(!empty($this->msg)){
            foreach($this->msg as $value)
            echo $value;
        }
        ?>
