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
        <h1>Comic-Sidekick</h1>
        
    </div>
    <div class="content">
    <h2>Welcome, Please log in.</h2>
        <form method="post" action="#">
            <label>Username</label>
                <input type="text" id="username">
                    <p></p>
            <label>Password</label>
                <input type="password" id="password">
                    <p></p>
            <input type="submit" value="Submit">
        </form>
        <a href="Account.php">Skip</a>
    <p>Or <a href="NewUser.php">Create New User</a></p>
    </div>
</body>
</html>