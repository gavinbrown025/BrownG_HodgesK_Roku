<?php

//! return data in JSON
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8'); 

// 1. include database and objects
include_once '../config/database.php';
include_once '../objects/movie.php';

// 2. Instanciate databae and movie object
$database = new Database();
$db_connector = $database->getConnection();

$movie = new Movie($db_connector);

//! 3. Query movies based on different requests

if(isset($_GET['id']))   // a. /movie/read.php?id=1 >> return the movie with ID 1
{
    $results = $movie->getMovieByID($_GET['id']);
}
elseif(isset($_GET['genre']))    // b. /movie/read.php?genre=action  >> return all action movies
{   
    $results = $movie->getMovieByGenre($_GET['genre']);
}
else    // c. /movie/read.php >> return all movies 
{
    $results = $movie->getMovies();
}



//? 4. return the data in JSON format

echo json_encode($results); //*Take JPP out after

exit;