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
            /* Form styles */
            form {
                margin-top: 20px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            form input[type="text"], form input[type="submit"] {
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                margin-bottom: 10px;
                width: 300px;
                font-size: 16px;
            }

            form input[type="submit"] {
                background-color: #333;
                color: #fff;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            form input[type="submit"]:hover {
                background-color: #555;
            }
            
            .error {
                color: red;
                background-color: lightblue;
                font-size: 18px;
                padding: 10px;
                border-radius: 5px;
                margin: 20px auto;
                display: table; /* This is important */
            }


        </style>
    </head>
    <body>
        <h1>My Movie Database: Search</h1>
        <?php
            include('header.php');
        ?>
        <form method="POST" action="search_form.php">
            Title: <input type="text" name="title"><br>
            Year: <input type="text" name="year"><br>
            <input type="submit" value="Search" name="submit">
        </form>

        <?php
            if (isset($_POST['submit'])) {
                $title = isset($_POST['title']) ? $_POST['title'] : '';
                $year = isset($_POST['year']) ? $_POST['year'] : '';

                if (empty($title) && empty($year)) {
                    echo '<div class="error">Please enter a year or a title!</div>';             
                } else {
                    // Connect to database
                    $dbpath = getcwd() . '/database/movies.db';
                    $db = new SQLite3($dbpath);

                    // Prepare the SQL query based on input
                    $sql = "SELECT id, title, year FROM movies WHERE 1";
                    if (!empty($title)) {
                        $sql .= " AND title LIKE :title";
                    }
                    if (!empty($year)) {
                        $sql .= " AND year = :year";
                    }

                    $statement = $db->prepare($sql);

                    if (!empty($title)) {
                        $title = "%" . $title . "%";
                        $statement->bindValue(':title', $title, SQLITE3_TEXT);
                    }
                    if (!empty($year)) {
                        $statement->bindValue(':year', $year, SQLITE3_INTEGER);
                    }

                    $result = $statement->execute();

                    // Iterate over the movies and generate output
                    while ($array = $result->fetchArray()) {
                        print ' - ' . $array['title'] . ' (' . $array['year'] . ')' . '<br>';
                    }

                    $db->close();
                    unset($db);
                }
            }
        ?>


    </body>
</html>
