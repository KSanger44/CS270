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
        <h2>Search for CHARACTER(s) containing...</h2>
        <div class="search">
            <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="text" name = "search" >
                <input type="submit" >
            </form>
        </div>
        
        <div class="results">

                    <?php
    
        //connect to db schema
        $servername = 'localhost';
        $username = 'root';
        $password = "";
        $dbname = "comicbook1";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // access and store the form inputs in a variable
      
            
        if(isset($_GET['search'])){
            
            $queryChar = $_GET['search'];
        }
        else {
            $queryChar = "";
        }
    
        if(isset($_GET['search'])){
            
            //execute the sql query
            $sql = "select distinct Series.SeriesName, Volume, IssueNum, PrimaryWriter, PrimaryCharacter, GuestCharacter
                    from SERIES, ISSUES 
                    where ISSUES.seriesID = SERIES.seriesID
                    and PrimaryCharacter like '%$queryChar%'
                    or GuestCharacter like '%$queryChar%'";
    
            //display the sql result set in an html table
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
            //output each result row
            
                echo "<table>";
                echo "<tr>";
                    echo "<th>Series Name</th>";
                    echo "<th>Volume</th>";
                    echo "<th>Issue</th>";
                    echo "<th>Author</th>";
                    echo "<th>Primary Character</th>";
                    echo "<th>Guest Character</th>";
                    echo "<th>Add to Collection?</th>";
                echo "</tr>";
    
                while($row = $result->fetch_assoc()){
                        echo "<tr>";
                            echo "<td>" . $row['SeriesName'] . "</td>";
                            echo "<td>" . $row['Volume'] . "</td>";
                            echo "<td>" . $row['IssueNum'] . "</td>";
                            echo "<td>" . $row['PrimaryWriter'] . "</td>";
                            echo "<td>" . $row['PrimaryCharacter'] . "</td>";
                            echo "<td>" . $row['GuestCharacter'] . "</td>";
                            $temp = "addCollection.php?" . "SeriesName=" . $row['SeriesName'] ."&" . "Volume=" . $row['Volume'] ."&" . "IssueNum=" . $row['IssueNum'];
                            echo "<td><a href='" . $temp . "'>Add to Collection</a></td>";
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
            
        </div>
        
        <h3>If you don't see the issue you're looking for, <a href="addseries.php">Add it to Comic-Sidekick's database</a></h3>
    </div>
    

    
</body>
</html>