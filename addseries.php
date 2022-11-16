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
        <h3>Add <span style="color:crimson">SERIES</span>to our database by entering the information below.</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table>
                <tr>
                    <td>Series Name:</td>
                    <td><input type="text" name="series" required></td>
                </tr>
                <tr>
                    <td>Volume:</td>
                    <td><input type="text" name="vol" required></td>
                </tr>           
                <tr>
                    <td>Primary Character:</td>
                    <td><input type="text" name="char" required></td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td><input type="text" name="author" required></td>
                </tr>
                <tr>
                    <td>Initial Publish Date:</td>
                    <td><input type="date" name="firstpub" required></td>
                </tr>
                <tr>
                    <td>Last Publish Date:</td>
                    <td><input type="date" name="lastpub" required></td>
                </tr>
                <tr>
                <td>Notes:</td>
                <td>    
                <textarea name="notes" rows="5" cols="25"></textarea>
                </td>    
                <tr>
                    <td></td>
                    <td> <input type="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
        <h3>Go <a href="addissues.php">here</a> to add individual Issues</h3>
        
    </div>
    
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
    
        $seriesName = isset($_POST['series']) ? $_POST['series'] : "";
        $volume = isset($_POST['vol']) ? $_POST['vol'] : "";
        $character = isset($_POST['char']) ? $_POST['char'] : "";
        $writer = isset($_POST['author']) ? $_POST['author'] : "";
        $firstpub = isset($_POST['firstpub']) ? $_POST['firstpub'] : "";
        $lastpub = isset($_POST['lastpub']) ? $_POST['lastpub'] : "";
        $notes = isset($_POST['notes']) ? $_POST['notes'] : "";
    
        if(isset($_POST['series']) && $seriesName != ""){
            
            //insert into Series table
            
            $sql = "INSERT INTO `series` (`SeriesID`, `SeriesName`, `Volume`, `PrimaryCharacter`, `PrimaryWriter`, `FirstPubDate`, `LastPubDate`, `Notes`) VALUES (NULL, '$seriesName', '$volume', '$character', '$writer', '$firstpub', '$lastpub', '$notes')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>New record created successfully</p>";
            } 
            else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }


        }//end of isset if stmt
        
  $conn->close();      
    ?>
    
</body>
</html>