<html>
    <head>
        <title>KDD Management System</title>
        <link rel="stylesheet" href="list.css">
    </head>

    <?php
    //call file to connect server eleave
    include ("header.php");
    ?>
    <h2>List of Product</h2>

    <?php
    //make the query
    $q = "SELECT productID, productName, productPrice, productCategory
        FROM product
        ORDER BY productID";

        //run the query and assign to the variable $result
        $result = @mysqli_query ($connect, $q);

        if($result)
        {
            //table heading
            echo '<table border ="2">
            <tr>
            <td align = "center"><strong> ID </strong></td>
            <td align = "center"><strong> NAME </strong></td>
            <td align = "center"><strong> PRICE </strong></td>
            <td align = "center"><strong> CATEGORY </strong></td>
            <td align = "center"><strong> UPDATE </strong></td>
            <td align = "center"><strong> DELETE </strong></td>
            </tr> ';

            //fetch and print all the records
            while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo '<tr>
                <td>'.$row['productID'].'</td>
                <td>'.$row['productName'].'</td>
                <td>'.$row['productPrice'].'</td>
                <td>'.$row['productCategory'].'</td>
                <td align = "center"><a href="productUpdate.php?id='.$row['productID'].'">Update</a></td>
                <td align = "center"><a href="productDelete.php?id='.$row['productID'].'">Delete</a></td>
                </tr>';
            }
            //close the table
            echo '</table>';

            //free up the resources
            mysqli_free_result($result);

             // add back button
             echo '<button class="main-button" onclick="location.href=\'main.html\'">Back to Main Page</button>';

            //if failed to run
        }
        else
        {
            //error message
            echo '<p class = "error"> the current product could not be
            retrieved. we apologise for any inconvenience.</p>';

            //debugging message 
            echo '<p>'. mysqli_error($connect).'<br><br/>Query:'.$q.'</p>';
        }//end of it ($result)
        //close the database connection
        mysqli_close($connect);
        ?>

<button onclick="location.href='productRegister.php'">Add Product</button>


</div>
</div>
</body>
</html> 
