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
        <h3>Add <span style="color:crimson">ISSUES</span> to our database by entering the information below.</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table>
                <tr>
                    <td>Series Name:</td>
                    <td>
                        <select name="sName" id="sName">
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

                            $sql = "select distinct SeriesName from SERIES";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                            while($row = $result->fetch_assoc()) {

                            echo "<option value='" . $row['SeriesName'] . "'>" . $row['SeriesName'] . "</option>";

                            }  //end of while


                            }   //end of if
                                    $conn->close();

                            ?></select></td>
                </tr>
                <tr>
                    <td>Volume:</td>
                    <td><input type="text" name="vol" required></td>
                </tr>
                <tr>
                    <td>Issue Number:</td>
                    <td><input type="text" name="issueNum" required></td>
                </tr>
                <tr>
                    <td>Guest Character:</td>
                    <td><input type="text" name="guestChar" ></td>
                </tr>
                <tr>
                    <td>alt Issue:</td>
                    <td><input type="text" name="altData" ></td>
                </tr>

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
        <h3>Go <a href="addseries.php">here</a> to add more Series</h3>

    </div>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comicbook1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
//else {
//  echo "<p>Connected to the database successfully</p>";
//}

$sName = isset($_POST['sName']) ? $_POST['sName'] : "";
$vol = isset($_POST['vol']) ? $_POST['vol'] : "";
$sql = "SELECT SERIES.SeriesID FROM SERIES WHERE SERIES.SeriesName = '$sName' AND SERIES.Volume = '$vol' ";
$result = $conn->query($sql);
//echo $sql;
if($result->num_rows === 1){
//$row = ($result->fetch_assoc());
//$sID = $row['SeriesID'];


$row = ($result->fetch_assoc());
$sID = current($row);

//echo "<p>" . $sID . "</p>";

$altData = isset($_POST['altData']) ? $_POST['altData'] : "";
$IssueNum = isset($_POST['issueNum']) ? $_POST['issueNum'] : "";
$guestChar = isset($_POST['guestChar']) ? $_POST['guestChar'] : "";
$notes = isset($_POST['notes']) ? $_POST['notes'] : "";

//echo "<p>" . $IssueNum . "</p>";

if(isset($_POST['issueNum']) && $IssueNum != "") {
$sql2 = "INSERT INTO ISSUES (`SeriesID`, `IssueNum`, `AlternativeIssueData`, `GuestCharacter`, `Notes`)
VALUES ('$sID', '$IssueNum', '$altData', '$guestChar', '$notes')";
//echo "<p>" . $sql2 . "</p>";



if($conn->query($sql2) === TRUE) {

  echo "<p> New Record created successfully.</p>";
}
  else {
    echo "<p> Error: " . $sql . "<br>" . $conn->error . "/p>";
  }
}
}
?>

</body>
</html>
