<html>
    <head>
        <title>KDD Management System</title>
        <link rel="stylesheet" href="delete.css">
</head>
<body>
    <?php
    //call file to connect server eLeave
    include ("header.php");
    ?>

    <h2> Delete Product Record </h2>

    <?php
    //look for a valid product id, either through GET or POST
    if ((isset ($_GET['id'])) && (is_numeric($_GET['id'])))
    {
        $pid = $_GET['id'];
    }
    else if ((isset ($_POST['id'])) && (is_numeric($_POST['id'])))
    {
        $pid = $_POST['id'];
    }
    else
    {
        echo '<p class= "error">This page has been accessed in error.</p>';
        exit();
    }

    if ($_SERVER['REQUEST_METHOD']== 'POST')
    {
        if ($_POST['sure']=='Yes')//delete the record
        {
            //make the query
            $q = "DELETE FROM product WHERE productID = $pid LIMIT 1";
            $result = @mysqli_query($connect, $q); //run the query

            if (mysqli_affected_rows($connect) == 1)//if therw was a problem
            //display message
            {
                echo '<script>alert("The product has been deleted");
                window.location.href = "productList.php";</script>';
            }
            else
            {
                //display error message
                echo '<p class = "error"> the record could not be deleted <br>
                Probarly because it does not exist or due to system error.</p>';

                echo '<p>'.mysqli_error($connect).'<br/> Query:'.$q.'</p>';
                //debugging message
            }
        }
        else
        {
            echo '<script>alert("The product has NOT been deleted");
            window.location.href = "productList.php";</script>';
        }
    }
    else
    {
        //display the form
        //retrieve the member data

        $q = "SELECT productName FROM product WHERE productID = $pid";
        $result = @mysqli_query($connect, $q); //run the query

        if (mysqli_num_rows($result)==1)
        {
            //get admin information
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            echo "<h3>Are you sure want to permanently delete $row[0]? </h3>";
            echo ' <form action="productDelete.php" method= "post">
            <input id ="submit-no" type="submit" name="sure" value="Yes">
            <input id ="submit-no" type="submit" name="sure" value="No">
            <input type="hidden" name="id" value="'.$pid.'">
            </form>';
        }
        else
        { //if it didnt run
            //message
            echo '<p class ="error">This page has been accessed in error<p>';
            echo '<p>&nbsp;</p>';
        } //end of it(result)
    }
    mysqli_close($connect); //close the database connection_aborted
    ?>
</body>
</html>