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
       <div class ='form'>
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
    
        $sql = "select UserName from users";
        $result = $conn->query($sql);
        
        $seriesName = isset($_GET['SeriesName']) ? $_GET['SeriesName'] : "";
        $volume = isset($_GET['Volume']) ? $_GET['Volume'] : "";
        $issue = isset($_GET['IssueNum']) ? $_GET['IssueNum'] : "";
        
    
    echo "<form method='post' action=" . htmlspecialchars($_SERVER['PHP_SELF']) . ">";
        
        echo "<label>User</label>";
        echo "<select name='users' id='users'>";
        
        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                
                echo "<option value='" . $row['UserName'] . "'>" . $row['UserName'] . "</option>";
                
                }  //end of while
            
            
                }   //end of if
        echo "</select>";
        echo "<p></p>";
        
        echo "<label>SeriesName</label>";
        echo "<input type='text' name='seriesName' value = '" . $seriesName . "' required />";
        echo "<p></p>";
        
        echo "<label>Volume</label>";
        echo "<input type='text' name='Volume' value = '" . $volume . "' required />";
        echo "<p></p>";
        
        echo "<label>Collection</label>";
        echo "<input type='text' name='collection' required />";
        echo "<p></p>";
           
        echo "<label>Issue</label>";
        echo "<input type='text' name='issue' value = '" . $issue . "' required />";
        echo "<p></p>";
           
        echo "<label># of Copies</label>";
        echo "<input type='text' name='numCopies' required />";
        echo "<p></p>";
           
        echo "<label>Condition</label>";
        echo "<input type='text' name='condition' required />";
        echo "<p></p>";
           
        echo "<label>Est. Worth</label>";
        echo "<input type='text' name='estPrice' required />";
        echo "<p></p>"; 
           
        echo "<label>Container</label>";
        echo "<input type='text' name='container' required />";
        echo "<p></p>";
           
        echo "<input type='submit' value='Add to Collection'/>";
     echo "</form>";
           
        $collection = isset($_GET['collection']) ? $_GET['collection'] : "";
        $issue = isset($_GET['issue']) ? $_GET['issue'] : "";
        $numCopies = isset($_GET['numCopies']) ? $_GET['numCopies'] : "";
        $condition = isset($_GET['condition']) ? $_GET['condition'] : "";
        $price = isset($_GET['estPrice']) ? $_GET['estPrice'] : "";
        $container = isset($_GET['container']) ? $_GET['container'] : "";

        
        $add = "INSERT INTO `collections_items` (`ItemID`, `CollectionID`, `IssueID`, `NumberOFCopies`, `Condition`, `EstPrice`, `ContainerID`) VALUES (NULL, '$collection', '$issue', '$numCopies', '$condition', '$price', '$container')";

        if ($conn->query($add) === TRUE) {
        echo "<p>New record created successfully</p>";
        }    


        
  $conn->close();          
        
    ?>
        </div>
    </div>
    </body>
</html>
    