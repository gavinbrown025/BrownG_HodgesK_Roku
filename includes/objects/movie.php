<?php
class Movie
{
    private $conn;

    public $movie_table = 'tbl_movies';
    public $genre_table = 'tbl_genre';
    public $movie_genre_linking_table = 'tbl_mov_genre';

    public function __construct($db_connector){
        $this->conn = $db_connector;
    }

    public function getMovies(){ //* return all movies
        //$query = 'SELECT * FROM '.$this->movie_table;  

        $query = 'SELECT m.*,'; 
        $query .= 'GROUP_CONCAT(g.genre_name) AS genre_name ';
        $query .= 'FROM '.$this->movie_table.' m ';
        $query .= 'LEFT JOIN '.$this->movie_genre_linking_table.' link ';
        $query .= 'ON link.movies_id = m.movies_id ';
        $query .= 'LEFT JOIN '.$this->genre_table.' g ';
        $query .= 'ON g.genre_id = link.genre_id ';
        $query .= 'GROUP BY m.movies_id ';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);        
    }

    public function getMovieByGenre($genre){ //* return all movies in a genre
        $query = 'SELECT m.*, 
        GROUP_CONCAT(g.genre_name) AS genre_names 
        FROM '.$this->movie_table.' m 
        LEFT JOIN '.$this->movie_genre_linking_table.' 
        link ON link.movies_id = m.movies_id 
        LEFT JOIN '.$this->genre_table.' g 
        ON g.genre_id = link.genre_id 
        WHERE g.genre_name = "%'.$genre.'%" 
        GROUP BY m.movies_id';

        echo $query;
        exit;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    }

    public function getMovieByID($id){ //* return specific movie by its id

       //$query = 'SELECT * FROM '.$this->movie_table.' WHERE `movies_id` ='.$id;
        $query = 'SELECT m.*, 
        GROUP_CONCAT(g.genre_name) AS genre_names 
        FROM '.$this->movie_table.' m 
        LEFT JOIN '.$this->movie_genre_linking_table.' 
        link ON link.movies_id = m.movies_id 
        LEFT JOIN '.$this->genre_table.' g 
        ON g.genre_id = link.genre_id 
        WHERE m.movies_id = "'.$id.'" 
        GROUP BY m.movies_id';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}