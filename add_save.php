<?php
    session_start();

    // grab data from the user
    $title = $_POST['title'];
    $year = $_POST['year'];

    // connect to database
    $dbpath = getcwd() . '/database/movies.db';
    $db = new SQLite3($dbpath);

    // validate input
    if (empty($title) || empty($year)) {
        $_SESSION['error_message'] = 'Please fill in both title and year!';
        header("Location: add_form.php");
        exit();
    }

    // insert a record into our table
    $sql = "INSERT INTO movies (title, year) VALUES (:title, :year)";
    $statement = $db->prepare($sql);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':year', $year);
    $result = $statement->execute();

    $rows_affected = $db->changes();

    $db->close();
    unset($db);

    // check if the insert was successful
    if (!$result || $rows_affected == 0) {
        $_SESSION['error_message'] = 'Movie could not be added. Please try again.';
        header("Location: add_form.php");
        exit();
    }

    // store success message in session
    $_SESSION['success_message'] = 'Movie was added successfully!';

    // redirect them back so they can add more movies to the database
    header("Location: add_form.php");
    exit();
?>
