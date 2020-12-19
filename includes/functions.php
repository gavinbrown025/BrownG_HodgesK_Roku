<?php

    $result = array();

    function getMovies($conn) {
        $query = 'SELECT m.*, 
        GROUP_CONCAT(g.genre_name) 
        AS genre_name 
        FROM tbl_movies m 
        LEFT JOIN tbl_mov_genre link 
        ON link.movies_id = m.movies_id 
        LEFT JOIN tbl_genre g 
        ON g.genre_id = link.genre_id 
        GROUP BY m.movies_id';

        $runQuery = $conn->query($query);
        while($row = $runQuery->fetchAll(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        
        echo (json_encode($result));
    }

    function getMovieByID($conn, $id){ //* return specific movie by its id

       //$query = 'SELECT * FROM '.$this->movie_table.' WHERE `movies_id` ='.$id;
        $query = 'SELECT m.*, 
        GROUP_CONCAT(g.genre_name) AS genre_names 
        FROM tbl_movies m 
        LEFT JOIN tbl_mov_genre link 
        ON link.movies_id = m.movies_id 
        LEFT JOIN tbl_genre g 
        ON g.genre_id = link.genre_id 
        WHERE m.movies_id = "'.$id.'" 
        GROUP BY m.movies_id';
        
        $runQuery = $conn->query($query);
        while($row = $runQuery->fetchAll(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        
        echo (json_encode($result));
    }
