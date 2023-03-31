<html>
    <head>
        <title>KDD Management System</title>
        <link rel="stylesheet" href="search.css">
</head>
<body>
    <?php
    //call file to connect server eLeave
    include ("header.php");
    ?>

    <form action="productFound.php" method="post">

    <h1>Search product record</h1>
    <p><label class ="label" for="productName">Product Name:</label>
    <input id="productName" type="text" name="productName"size="30"
    maxlength="50" value="<?php if (isset($_POST['productName']))
    echo $_POST['productName']; ?>"/></p>

    <input id="submit" type="submit" name="submit" value="search"/></p>
    </form>
</body>
</html>