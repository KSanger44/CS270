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
    <div class="content">
    <h3>Please enter your email, a unique User ID, and Password</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" style="min-width: 150px"></td>
                </tr>
            </table>
        </form>
        <p>Or <a href="index.php">Go Back</a></p>
        
    <?php
        //connect to the db schema
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "comicbook1";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
    
        $userName = isset($_POST['username']) ? $_POST['username'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $password = isset($_POST['password']) ? $_POST['password'] : "";

    
        if(isset($_POST['username']) && $userName != ""){
            
            //insert into Users table
            $check = "select * from users where UserName = '$userName'";
            $checkExec = $conn->query($check);
            if ($checkExec->num_rows > 0) {
                echo "<p>Profile already exists</p>";
                
            } 
            else{
            
                $sql = "INSERT INTO `users` (`UserName`, `Password`, `EmailAddress`) VALUES ('$userName', '$email', '$password')";

                if ($conn->query($sql) === TRUE) {
                    echo "<p>New user created successfully</p>";
                    echo "<p>Please return to home screen and <a href='index.php'>login</a></p>";
                } 
                else {
                    echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
                }
            }


        }//end of isset if stmt
        
  $conn->close();      
    ?>        
        
    </div>
</body>
</html>