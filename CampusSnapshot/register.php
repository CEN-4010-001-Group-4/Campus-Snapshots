<?php
// Include config file
require_once "../Login/Login.php";
 
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

// Define variables and initialize with empty values
$username = $password = $confirm_password = $firstname = $lastname = "";
$username_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 


    // Validate email address
    if(empty(trim($_POST["email"]))){
        $username_err = "Please enter a valid email.";
    } else{
        $username = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
          $username_err = "Invalid email format";
        }else{
            // Prepare a select statement
            $sql = "SELECT id FROM Users WHERE username = ?";
            
            if($stmt = $db->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_username);
                
                // Set parameters
                $param_username = trim($_POST["email"]);
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // store result
                    $stmt->store_result();
                    if($stmt->num_rows == 1){
                        $username_err = "This email is already taken.";
                    }else{
                        $username = trim($_POST["email"]);
                    }
                }
                else{
                    echo "Error occurred, try again..";
                }
                    // Close statement
            $stmt->close();    
            }
        }
    }




    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password does not match";
        }
    }

    // Validate first name
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter first name:";     
    } else{
        $firstname = trim($_POST["firstname"]);
    }

    //Validate last name
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter last name:";     
    } else{
        $lastname = trim($_POST["lastname"]);
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)&& empty($firstname_err)&& empty($lastname_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO Users (username, password, firstname, lastname) VALUES (?,?,?,?)";
         
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_username, $param_password,$param_firstname,$param_lastname);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_firstname = $firstname;
            $param_lastname = $lastname;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        // Close statement
        $stmt->close();    
        }
    }
    
    // Close connection
    $db->close();
}

//Function tests that the user enters a valid email address
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-153601537-1');
    </script>

</head>
<body>
    <div class="container">
    <h1>Campus Snapshot Registration</h1>
        <div class ="row">
            <div class ="col-sm-12">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    
                    <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                        <label>First name: </label>
                        <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                        <span class="help-block"><?php echo $firstname_err; ?></span>
                    </div> 

                    <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                        <label>Last name: </label>
                        <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                        <span class="help-block"><?php echo $lastname_err; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Email: </label>
                        <input type="text" name="email" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div> 

                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password: </label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password: </label>
                        <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
                <p>Already have an account?</p><button type="submit" name="signInBtn" id="signInBtn" class="btn btn-primary">Sign In!</button>
            </div>
        </div>        
    </div>
    
    <script type="text/javascript">
    document.getElementById("signInBtn").onclick = function () {
        location.href = "http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/login.php";
    };
    </script>      
</body>
</html>