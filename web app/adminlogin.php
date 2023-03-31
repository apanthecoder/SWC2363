<html>
<head>
    <title>KDD Management System</title>
    <link rel="stylesheet" href="login.css">

</head>
<body>
    <?php
    //call file to connect server eleave
    include("header.php");
    ?>

    <?php
    //this section processes submission from the login form
    //check if the form has been submitted
    if($_SERVER['REQUEST_METHOD']== 'POST')
    {     
        //validate the adminID
        if (!empty($_POST['adminID']))
        {
            $id = mysqli_real_escape_string($connect, $_POST['adminID']);
        }
        else 
        {
            $id = FALSE;
            echo '<p class="error">You forgot to enter your ID.</p>';
        }

        //validate the adminPassword
        if (!empty($_POST['adminPassword']))
        {
            $p = mysqli_real_escape_string($connect, $_POST['adminPassword']);
        }
        else
        {
            $p = FALSE;
            echo '<p class="error">You forgot to enter your password.</p>';
        }

        //if no problems
        if ($id && $p)
        {
            //retrive the adminID, adminPassword, adminName, adminPhoneNo, adminEmail
            $q = "SELECT adminID, adminPassword, adminName, adminPhoneNo, adminEmail FROM admin WHERE (adminID='$id' AND adminPassword='$p')";

            //run the query and assign it to the variable $result
            $result = mysqli_query($connect, $q);

            //count the number of rows that match the adminID/adminPassword combination
            //if one database row(record) matches the input:
            if (@mysqli_num_rows ($result) ==1)
            {
                 //redirect the user to another page
                 header("Location: main.html");
                 exit();
            }
            //no match was made
            else
            {
                echo '<p class="error">The adminID and adminPassword entered do not match our records.<br>Perhaps you need to register, just click the register button.</p>';
            }
        }
        //if there was a problem
        else 
        {
            echo '<p class="error">Please try again.</p>';
        }

        mysqli_close($connect);
    }//end of submit conditional
    ?>

    <h2>ADMIN LOGIN</h2>
        
    <form action="adminlogin.php" method="post">
        <div>
            <label for="adminID">Admin ID:</label>
            <input type="text" id="adminID" name="adminID" size="4" maxlength="6" value="<?php if (isset($_POST['adminID'])) echo $_POST['adminID']; ?>">
        </div><br>
        
        <div> 
            <label for="adminPassword">Password:</label>
            <input type="password" id="adminPassword" name="adminPassword" size="15" maxlength="60" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required value="<?php if (isset($_POST['adminPassword'])) echo $_POST['adminPassword']; ?>">
        </div><br>
        
        <div>
            <button type="submit">Login</button>
            <button type="reset">Reset</button>
        </div>

        <div>
            <label>Dont have an account?
                <a href="adminRegister.php">Sign up</a>
            </label>
        </div>
        <div>
        <button class="user-btn" onclick="location.href='index.html'">For user</button>
        </div>
    </form>
</body>
</html>

