<html>
    <head>
        <title>KDD Management System</title>
        <link rel="stylesheet" href="productregister.css">
</head>
<body>
    <?php
    //call file to connect server eLeave
    include("header.php");
    ?>

    <?php
    //this query inserts a record in the eLeave table
    //has form been submitted?
    if ($_SERVER['REQUEST_METHOD']== 'POST')
    {
        $error = array(); //intialize an error array

    //check for a productName
    if (empty ($_POST['productName']))
    {
            $error[] = 'you forgot to enter your product name.';
    }
    else
    {
            $pn = mysqli_real_escape_string($connect, trim($_POST['productName']));
    }

     //check for productPrice
     if (empty ($_POST['productPrice']))
     {
             $error[] = 'you forgot to enter product price.';
     }
     else
     {
             $pp = mysqli_real_escape_string($connect, trim($_POST['productPrice']));
     }

      //check for productCategory
    if (empty ($_POST['productCategory']))
    {
            $error[] = 'you forgot to enter product category.';
    }
    else
    {
            $pc = mysqli_real_escape_string($connect, trim($_POST['productCategory']));
    }

    //register the admin in the database
    //make the query
    $q ="INSERT INTO product (productID, productName, productPrice, productCategory)
        VALUES  ('', '$pn', '$pp', '$pc')";

    $result = @mysqli_query ($connect, $q);//run the query
    if ($result)//if it runs
    {
        echo '<h1>thank you</h1>';
        echo '<p>Your product has been successfully registered.</p>';
        echo '<p><a href="main.html">Go to main page</a></p>';
        exit();
    }

    else
    { //if it didnt run
        //message
        echo '<h1>System error</h1>';

        //debugging message
        echo '<p>' .mysqli_error($connect). '<br><br>Query: '.$q.' </p>';
  } //end of it(result)
  mysqli_close($connect);//close the database connection_aborted
  exit();
} //end of the main submit conditional
?>

        <h2> Register Product </h2>
        <h4> *required field </h4>
        <form action="productRegister.php" method="post">

        <div>
        <label for="productName">Product Name*:</label>
        <input type="text" id="productName" name="productName" size="30" maxlength="50" 
        required value="<?php if (isset($_POST['productName']))echo $_POST['productName'];?>">
        </div>
        <br>
        
        <div>
        <label for="productPrice">Product Price*:</label>
        <input type="text" id="productPrice" name="productPrice" size="30" maxlength="50" 
        required value="<?php if (isset($_POST['productPrice']))echo $_POST['productPrice'];?>">
        </div>
        <br>

        <div>
        <label for="productCategory">Product Category*:</label>
        <input type="text" id="productCategory" name="productCategory" size="30" maxlength="50" 
        required value="<?php if (isset($_POST['productCategory']))echo $_POST['productCategory'];?>">
        </div>
        <br>

        <div>
                <button type="submit">register</button>
                <button type="reset">Clear All</button>

</div>
</form>
</body>
</html>

