<?php
// Check if the movie id is set in the URL
if (isset($_GET['id'])) {
    // Get the movie id from the URL
    $movie_id = intval($_GET['id']);

    // Connect to the database
    $dbpath = getcwd() . '/database/movies.db';
    $db = new SQLite3($dbpath);

    // Set up a SQL query to delete the movie from the table
    $sql = "DELETE FROM movies WHERE id=:id";
    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $movie_id, SQLITE3_INTEGER);

    // Execute the query
    $result = $statement->execute();

    // Close the database connection and unset the variable
    $db->close();
    unset($db);

    // Redirect the user back to the index.php file
    header("Location: index.php");
    exit();
} else {
    // If the movie id is not set in the URL, redirect the user back to the index.php file
    header("Location: index.php");
    exit();
}
?>
