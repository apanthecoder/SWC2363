<html>
    <head>
        <title>Database connection</title>
    </head>
    <body>
        <?php

 

        //connect to server 
        $connect = mysqli_connect("localhost", "root", "", "kopiduadarjat");

        if (!$connect)
        {
            die('ERROR :' . mysqli_connect_error());
        }
        ?>
    </body>
</html>
