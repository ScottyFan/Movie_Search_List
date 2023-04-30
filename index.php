<!doctype html>
<html>
    <head>
        <title>Movie Database</title>
        <style>
            /* General styles */
            body {
                font-family: Arial, sans-serif;
                font-size: 14px;
                line-height: 1.5;
            }

            h1 {
                margin-top: 40px;
                margin-bottom: 20px;
                text-align: center;
            }

            /* Navigation styles */
            #navigation {
                background-color: #333;
                color: #fff;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
            }

            #navigation a {
                color: #fff;
                text-decoration: none;
                padding: 10px;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            #navigation a:hover {
                background-color: #555;
            }

            #navigation a.active {
                background-color: #555;
            }

            /* Table styles */
            table {
                border-collapse: collapse;
                margin: 20px auto;
                width: 80%;
            }

            th, td {
                border: 1px solid #ccc;
                padding: 10px;
                text-align: left;
                vertical-align: top;
            }

            th {
                background-color: #eee;
                font-weight: bold;
            }

            .delete-link {
                color: red;
                text-decoration: none;
                margin-left: 10px;
            }

            .delete-link:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <h1>My Movie Database: View</h1>

        <?php
            include('header.php');
        ?>

        <!-- grab all movies from the database and display to the user -->
        <?php

            // connect to database
            $dbpath = getcwd() . '/database/movies.db';
            $db = new SQLite3($dbpath);

            // set up a SQL query to get all movies from the table
            $sql = "SELECT id, title, year FROM movies";
            $statement = $db->prepare($sql);
            $result = $statement->execute();

            // output table header
            echo '<table>';
            echo '<tr><th>Title</th><th>Year</th><th>Option</th></tr>';

            // iterate over those movies and generate output
            while ($array = $result->fetchArray()) {
                echo '<tr>';
                echo '<td>' . $array['title'] . '</td>';
                echo '<td>' . $array['year'] . '</td>';
                echo '<td><a class="delete-link" href="delete.php?id=' . $array['id'] . '">Delete</a></td>';
                echo '</tr>';
            }

            echo '</table>';

            $db->close();
            unset($db);

        ?>

    </body>
</html>