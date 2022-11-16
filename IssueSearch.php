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
        <h2>Which Series would you like to see Issues for?</h2>
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="series">Series</label>
            <select name="series" id="series">
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
                
                $sql = "select distinct SeriesName from series";
                
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()) {
                
                echo "<option value='" . $row['SeriesName'] . "'>" . $row['SeriesName'] . "</option>";
                
                }  //end of while
            
            
                }   //end of if
                        $conn->close();
        
            ?>
                
            </select>
            <input type="submit" value="Go">
        </form>

        
        <div class="results">

                    <?php
    
        //connect to db schema
        $servername = 'localhost';
        $username = 'root';
        $password = "";
        $dbname = "comicbook1";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // access and store the form inputs in a variable
      
            
        if(isset($_GET['series'])){
            
            $queryIssues = $_GET['series'];
        }
        else {
            $queryIssues = "";
        }
    
        if(isset($_GET['series'])){
            
            //execute the sql query
            $sql = "select * from ISSSUES where SERIES.SeriesID = ISSUES.SeriesID and SeriesName like '%$queryIssues%'";
            
            //$sql = "select distinct * from SERIES, ISSUES where SeriesName like '%$querySeries%'";
    
            //display the sql result set in an html table
            $result = $conn->query($sql);
    
            
                echo "<table>";
                echo "<tr>";
                    echo "<th>Series Name</th>";
                    echo "<th>Volume</th>";
                    echo "<th>Issue</th>";
                    echo "<th>Author</th>";
                    echo "<th>Release Date</th>";
                    echo "<th>Add to Collection?</th>";
                echo "</tr>";
    
                while($row = $result->fetch_assoc()){
                        echo "<tr>";
                            echo "<td>" . $row['SeriesName'] . "</td>";
                            echo "<td>" . $row['Volume'] . "</td>";
                            echo "<td>" . $row['IssueNum'] . "</td>";
                            echo "<td>" . $row['PrimaryWriter'] . "</td>";
                            echo "<td>" . $row['FirstPubDate'] . "</td>";
                            $temp = "addCollection.php?" . "SeriesName=" . $row['SeriesName'] ."&" . "Volume=" . $row['Volume'];
                            echo "<td><a href='" . $temp . "'>Add to Collection</a></td>";
                            //echo "<td><a href='addCollection.php?SeriesName=' . $row['SeriesName']'>Add to Collection</a></td>";
                        echo "</tr>";   
                } //end of while
            
                echo"</table>";

      
        } //end of isset if
        $conn->close();
    ?>
            

        
        <h3>If you don't see the series or issue you're looking for, <a href="addseries.php">Add it to Comic-Sidekick's database</a></h3>
    </div>
    </div>

    
</body>
</html>