<?php

class FilmModel{
    
    private $bdd;
    


    public function __construct() {
        $config = json_decode(
            file_get_contents(__DIR__."/../../config/" . ENV . "/db.json")
        );

        try {

            $this->bdd = new PDO($config->dsn,
                $config->user, $config->pswrd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            
        } catch (Exception $e) {

            var_dump('Echec lors de la tentative de connexion');
        }
    }

    public function getAllFilm($tableName, $table, $orderBy, $join, $tableCat, $joinCat) {
        try {
            $sql = 'SELECT * FROM ' . $tableName . " LEFT JOIN ". $join . " ON "
            . $tableName . "." . $tableCat . "=" . $join . "." . $joinCat;
            $execute = [];
            
            if(count($table) > 0){
                $i = 0;
                $sql .= " WHERE ";
                foreach($table as $parameter => $value){
                    if($i!== 0){
                        $sql .= ' AND ';
                    }
                    $sql = $sql . $parameter . " = ?";
                    array_push($execute, $value);
                    $i++;
                }
            }
            if(count($orderBy) > 0){
                $sql .= ' ORDER BY ' . $orderBy['field'] . ' ' . $orderBy['type'];
            }
            
            $request = $this->bdd->prepare($sql);
            
            $request->execute($execute);
            $film = $request->fetchAll();

            return $film;
        } catch (Exception $e) {
            var_dump('ERROR Film');
            
            return false;
        }
    }

    public function saveFilm($name, $year, $comment, $duration, $mark, $category, $isSeeing, $img, $tmdbId, $wish) {
        try {

            $request = $this->bdd->prepare('INSERT INTO movie 
                (
                    movie_name, 
                    movie_year, 
                    movie_comment,
                    movie_duration,
                    movie_mark,
                    id_category,
                    movie_is_seeing,
                    movie_img,
                    movie_tmdb_id,
                    movie_wish
                )

                VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ');
            $request->execute(array($name, $year, $comment, $duration, $mark, $category, $isSeeing, $img, $tmdbId, $wish));
            
            return true;
        } catch (Exception $e) {
            var_dump('ERROR Film ' . $e);
            return false;
        }
    }

    public function deleteFilm($id) {
        try {

            $request = $this->bdd->prepare('DELETE FROM movie WHERE movie_id = ? ');
            $request->execute(array($id));
            return true;
            
        } catch (Exception $e){
            var_dump('ERROR Film');
            return false;
        }
    }

    // public function setFilm($id) {
    //     try {

    //         $request = $this->bdd->prepare('UPDATE movie SET WHERE movie_id = ? ');
    //         $request->execute(array($id));
    //         return true;
            
    //     } catch (Exception $e){
    //         var_dump('ERROR Film');
    //         return false;
    //     }
    // }

    public function getFilmFromTMDB($type, $research) {
        $configApi = json_decode(
            file_get_contents(__DIR__."/../../config/" . ENV . "/api.json")
        );
        
        $request = file_get_contents('https://api.themoviedb.org/3/' . $type . '/movie?' . $configApi->moviedb->apiKey . '&language=en-US&' . $research . '&page=1&include_adult=false');
        $request = json_decode($request);
        return $request;
    }
    
    public function getDetailsFromTMDB($id) {
        $configApi = json_decode(
            file_get_contents(__DIR__."/../../config/" . ENV . "/api.json")
        );
        
        $details = file_get_contents('https://api.themoviedb.org/3/movie/' . $id . '?' . $configApi->moviedb->apiKey . '&append_to_response=videos,images');
        $details = json_decode($details);
        
        return $details;
    }

}
?>
