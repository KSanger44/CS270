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
        
        <h3>Who is using Comic-Sidekick?</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="users">User</label>
            <select name="users" id="users">
                <option value=""></option>
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

                if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()) {
                
                echo "<option value='" . $row['UserName'] . "'>" . $row['UserName'] . "</option>";
                
                }  //end of while
            
            
                }   //end of if
                        $conn->close();
        
            ?>
                
            </select>
            <input type="submit" value="Go">
        </form>
            
        <h1>Here are your collected comics!</h1>
        <div class="results">
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
            
                     //access and store the form inputs in a variable
        
                    if(isset($_POST['users'])){
                        $user = $_POST['users'];
                    }
                    else {
                        $user = "";
                    }
        
            
                    if(isset($_POST['users'])){
        
                    //create the sql query
                     $collection = "select * from collections, collections_items, issues, series
                    where collections.collectionID = collections_items.collectionID and collections_items.IssueID = issues.issueID and issues.seriesID = series.seriesID and Owner = '$user'";
                         
                    //display the sql result set in an html table
                    $display = $conn->query($collection);
                        
                    if ($display->num_rows > 0) {
                    //output each result row
            
                        echo "<table>";
                        echo "<tr>";
                            echo "<th>Series</th>";
                            echo "<th>Volume</th>";
                            echo "<th>Author</th>";
                            echo "<th>Condition</th>";
                            echo "<th>Est Worth</th>";
                            echo "<th>Remove from Collection?</th>";
                        echo "</tr>";
                        
                        while($row = $display->fetch_assoc()){
                        echo "<tr>";
                            echo "<td>" . $row['SeriesName'] . "</td>";
                            echo "<td>" . $row['Volume'] . "</td>";
                            echo "<td>" . $row['PrimaryWriter'] . "</td>";
                            echo "<td>" . $row['Condition'] . "</td>";
                            echo "<td>" . $row['EstPrice'] . "</td>";
                            //echo "<td><a href='Collection.php?ItemID=' . $row['ItemID']"'>Remove from Collection?</a></td>";
                            $temp = "Collection.php?" . "ItemID=" . $row['ItemID'];
                            echo "<td><a href='" . $temp . "'>Remove from Collection</a></td>";
                            if(isset($_POST['ItemID'])){
                                $delete = "DELETE FROM `collections_items` WHERE `collections_items`.`ItemID` =";
                                echo $delete; 
                                echo $row['ItemID'];}
                                
                                //echo "DELETE FROM `collections_items` WHERE `collections_items`.`ItemID` = $row['ItemID'];}"
                            
                            else {
                                echo "Error removing from collection";}
                            
                            echo "</tr>";   
                        } //end of while
            
                        echo"</table>";
                    } // end of if
                        else{
            
                        echo "<p>No results found.</p>";
                    }
      
                } //end of isset if
                    $conn->close();
            ?>
        
            
        <p><a href="addCollection.php">Click here</a> to add issues to your collection</p>
        
        </div>
    </div>
</body>
</html>