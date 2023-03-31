<html>
<head>
    <title>KDD Managment System</title>
    <link rel="stylesheet" href="found.css">
</head>
<body>
    <?php
    //call file to connect server eLeave
    include ("header.php");
    ?>

    <h2>Search Results</h2>

    <?php
    $in=$_POST['productName'];
    $in=mysqli_real_escape_string($connect, $in);

    //make the query
    $q = "SELECT productID, productName, productPrice, productCategory FROM product WHERE productName='$in' ORDER BY productID";

    //run the query and assign it to the variable $result
    $result = @mysqli_query($connect, $q);

    if ($result)
    {
        //table heading
        echo '<table border = "2">
        <tr>
        <td align = "center"><strong>ID</strong></td>
        <td align = "center"><strong>NAME</strong></td>
        <td align = "center"><strong>PRICE</strong></td>
        <td align = "center"><strong>CATEGORY</strong></td>
        </tr>';

        //fetch and print all the record
        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            echo '<tr>
            <td>'.$row['productID'].'</td>
            <td>'.$row['productName'].'</td>
            <td>'.$row['productPrice'].'</td>
            <td>'.$row['productCategory'].'</td>
            </tr>';
        }
        //close the table
        echo '</table>';

        //free up the resource
        mysqli_free_result($result);

         // add back button
         echo '<button onclick="location.href=\'main.html\'">Back to Main Page</button>';
         
        //if failed to run
    }
    else
    {
        //error message 
        echo '<p class = "error"> If no record is shown, this
        is because you had an incorrect or missing entry in
        search form.<br>Click the back button on the browser
        and try again.</p>';

        //debugging message
        echo '<p>'.mysqli_error ($connect).'<br><br/>Query:'.$q.'</p>';
    }//end of if ($result)
    //close the database connection
    mysqli_close($connect);
    ?>

</div>
</div>
</body>
</html>