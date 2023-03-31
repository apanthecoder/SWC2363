<html>
    <head>
        <title>KDD Management System</title>
        <link rel="stylesheet" href="update.css">
</head>
<body>
    <?php
    //call file to connect server eleave
    include ("header.php");
    // declare product ID variable
    ?>

    <?php


        if(isset($_POST['submit'])){

            $productid = $_POST['pid'];
            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];
            $productCategory = $_POST['productCategory'];

            $q = "UPDATE product SET productName ='$productName', productPrice = '$productPrice',
                    productCategory = '$productCategory' WHERE productID = '$productid'";

            $result = mysqli_query($connect, $q); //run the query
            if($result){
                echo '<script>alert("The prouct info has been edited");
                window.location.href ="productList.php";</script>';
            }else{

                echo '<script>alert("Failed to edit product info");
                window.location.href ="productList.php";</script>';
               //  echo '<p>'.mysqli_error($connect).'<br/> query:'.$q.'</p>'; 
            }

        }

        if ((isset($_GET['id'])) && (is_numeric($_GET['id'])))
        {
            $pid = $_GET['id'];

        }else{

            $pid = '';

        }

        if(empty($pid)){

            echo "<script>alert('Please Select One Product!'); window.location.href='productList.php'; </script>";

        }else{


            $q = "SELECT productID, productName, productPrice, productCategory FROM product WHERE productID = '$pid'";
            $result = @mysqli_query($connect, $q);
            $row = mysqli_fetch_array($result); 

        }

    ?>

    <h2> Edit Product Record </h2>

    <form action= "productUpdate.php" method = "post">
        <p><label class= "label" for="productName">Product Name*:</label>
        <input type="text" id="productName" name="productName" size="30"
        maxlength="50" value="<?php echo $row[1]; ?>" required></p>

        <p><label class= "label" for="productPrice">Product Price*:</label>
        <input type="text" id="productPrice" name="productPrice" size="30"
        maxlength="50" value="<?php echo $row[2]; ?>" required></p>

        <p><label class= "label" for="productCategory">Product Category*:</label>
        <input type="text" id="productCategory" name="productCategory" size="30"
        maxlength="50" value="<?php echo $row[3]; ?>" required></p>

        <br><p><input id="submit" type="submit" name="submit" value="Update"></p>
        <br><input type="hidden" name="pid" value="<?php echo $pid; ?>"/>
    </form>
  

</body>
</html>



    
    