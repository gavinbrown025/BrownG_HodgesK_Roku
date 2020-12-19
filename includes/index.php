<?php
    include("connect.php");
    include("functions.php");

    if(isset($_GET["id"])) {
        $targetGenre = $_GET["id"];
        $result = getMovieByGenre($pdo, $targetID);
        return $result;
        
    } elseif(isset($_GET["genre"])) {
        $targetGenre = $_GET["genre"];
        $result = getMovieByGenre($pdo, $targetGenre);
        return $result;
    
    } else {
        $result = getMovies($pdo);
        return $result;
    }