<!doctype html>
<html>
    <head>
        <?php session_start(); ?>
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

            .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            }

            .error {
            color: red;
            background-color: #ffe2e2;
            border: 1px solid red;
            }

            .success {
            color: green;
            background-color: #e5ffe5;
            border: 1px solid green;
            }

        </style>
    </head>
    <body>
        <h1>My Movie Database: Add</h1>
        <?php
            include('header.php');
        ?>

        <!-- Display error message if it exists -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="message error">
                <?= $_SESSION['error_message']; ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <!-- Display success message if it exists -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="message success">
                <?= $_SESSION['success_message']; ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>


        <form method="POST" action="add_save.php">
            Title: <input type="text" name="title"><br>
            Year: <input type="text" name="year"><br>
            <input type="submit" value="Save">
        </form>


    </body>

</html>