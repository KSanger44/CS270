<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="comic.css">
    <title>Welcome to Comic-Sidekick!</title>
</head>
<body>
    
    
    <div id="logo">
        <img src="Mhero.jpg"  style="float: left">
        <img src="Fhero.jpg"  style="float: right">
        <h1><a href="index.php" style="text-decoration: none; 
    color: crimson">Comic-Sidekick</a></h1>
        
    </div>
    
    
    <div id="navbar">
        <ul>
            <li><img src ="boltcursor.png"><a href="Account.php">Account</a></li>
            <div class="dropdown" style="border-style: solid; border-color: crimson;">
                <li class="dropbtn" style="border-style: none; display: block; width: 90%;"><img src ="boltcursor.png"><a href="#">Search</a></li>
                <div class="dropdown-content">
                    <a class="dropchoice" href="SeriesSearch.php"><img src ="boltcursor.png">By Series</a>
                    <a class="dropchoice" href="IssueSearch.php"><img src ="boltcursor.png">By Issue</a>
                    <a class="dropchoice" href="CharSearch.php"><img src ="boltcursor.png">By Character</a>
                </div>
            </div>    
            <li><img src ="boltcursor.png"><a href="Collection.php">Collection</a></li>
            <li><img src ="boltcursor.png"><a href="users.php">Users</a></li>
        </ul>
    </div>
    
    <div class="main">
        <h1>Hello, <span id="user">UserName</span>. Your account information is below.</h1>
        <div class="account">
            <p></p>
            <h3>Username:</h3>
            <p></p>
            <h3>Email:</h3>
            <p></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label>New Email</label><input type="email" name="email">
                <label>Verify Email</label><input type="email" name="veremail">
            </form>
            <h3>You can also change your password</h3>
            <form>
                <label>Old Password</label><input type="password" name="oldPassword">
                <p></p>
                <label>New Password</label><input type="password" name="newPassword">
                <p></p>
                <label>Verify New Password</label><input type="password" name="verPassword">
                <p></p>
                <input type="submit" value="Update">
            </form>
        </div>
    </div>
    
    <?php
        
        //connect to db schema
        $servername = 'localhost';
        $username = 'root';
        $password = "";
        $dbname = "comicbook1";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        // Store form data in variables
    
        if(isset($_POST['email'])){
            $updateEmail = $_POST['email'];
        }
        else {
            $updateEmail = "";
        }
    
         if(isset($_POST['veremail'])){
            $verEmail = $_POST['veremail'];
        }
        else {
            $verEmail = "";
        }
    
         if(isset($_POST['oldPassword'])){
            $oldPass = $_POST['oldPassword'];
        }
        else {
            $oldPass = "";
        }    
    
         if(isset($_POST['newPassword'])){
            $newPass = $_POST['newPassword'];
        }
        else {
            $newPass = "";
        }
    
         if(isset($_POST['verPassword'])){
            $verPass = $_POST['verPassword'];
        }
        else {
            $verPass = "";
        }      

        
        
        
    ?>
    
    
    
</body>
</html>