<?php
// Initialize the session
session_start();

// Check if the user is already logged in as admin, if yes then redirect them to admin page
if(isset($_SESSION["admin"]) && $_SESSION["admin"] === true){
    header("location: administration.php");
    exit;
}

// Check if the user is already logged in, if yes then redirect him to welcome page
else if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "../Login/Login.php";
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $reorder_query="SELECT * FROM AdminUsers WHERE username ="."'$username'";
        $reorder_result = $db->query($reorder_query);
            while($row = $reorder_result->fetch_assoc()) {
                if(($password == $row['password'])&&($username == $row['username'])){
                        // Password is correct, so start a new session
                        session_start();
                        
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["admin"] = true;
                        $_SESSION["username"] = $username;
                        $_SESSION["firstname"] = $firstname;          
                        
                        // Redirect user to welcome page
                        header("location: administration.php");
                    } else{
                        // Display an error message if password is not valid
                        $password_err = "The password you entered was not valid.";
                    }
                }
                $username_err = "User does not exist";
            }
    }
    // Close connection
    $db->close();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-153601537-1');
    </script>

</head>
<body>
    <div class="container">
        <div class ="row">
            <div class = "col-11">
                <h2>Campus Snapshots Admin Login</h2>
            </div>
            <div class = "col-1">
                <button type="submit" name="homeBtn" id="homeBtn" class="btn btn-primary">Home</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Email:</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </form>
            </div>
        </div>        
    </div>

    <script type="text/javascript">
    document.getElementById("homeBtn").onclick = function () {
        location.href = "http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/welcome.php";
    };

    </script>    
</body>
</html>