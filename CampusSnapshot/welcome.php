<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Campus Snapshots</title>

    <!--Bootstrap CSS Core-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-153601537-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-153601537-1');
    </script>

</head>
<body>
    <?php
    include 'functions.php';
    ?>
    <div class="container" >
        <div class="row">
            <div class="col-3">
                <button type="submit" name="hostEventBtn" id="hostEventBtn" class="btn btn-danger" style="margin-top: 10px;">Host Event</button>
                <button type="submit" name="reportIssueBtn" id="reportIssueBtn" class="btn btn-danger" style="margin-top: 10px;">Report an Issue</button>
            </div>
            <div class="col-6" style="background: #0275d8;border-radius:20px; color: white; text-align: center;">
                <h1>Campus Snapshots</h1>
            </div>
            <div class="col-3">
                <b>Hello, <?php echo $_SESSION["firstname"]; ?></b>
                <button type="submit" name="signOutBtn" id="signOutBtn" class="btn btn-danger" style="margin-top: 10px;">Log out!</button>
            </div>
        </div>
    </div>

    <div class = "container" style="margin-top: 30px;">
        <div class = "row" >
            <div class = "col-6" id="EventsContainer">
                <h3 style="text-align:center;">Events happening around campus</h3>
                <form action="" method="post" id="eventSortForm" enctype="multipart/form-data"> 
                    <p style="margin-left:15px;">
                        <b>Order By: </b>
                        <button type="submit" name="orderByRecent" class="btn btn-danger" style="margin-left:15px;">Most Recent</button>
                        <button type="submit" name="orderByLocation" class="btn btn-danger" style="margin-left:5px;">Location</button>
                    </p>
                </form>    
                <?php
                    display();
                ?>
            </div>
            <div class = "col-6" id="IssuesContainer">
                <h3 style="text-align:center;">Reported incidents</h3>
                <?php
                    DisplayIssues(); /*Displays the table with issues reported*/
                ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    document.getElementById("hostEventBtn").onclick = function () {
        location.href = "http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/hostEvent.php";
    };

    document.getElementById("reportIssueBtn").onclick = function () {
        location.href = "http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/ReportAnIssue.php";
    };

    document.getElementById("signOutBtn").onclick = function () {
        location.href = "http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/logout.php";
    };
    document.getElementById("signOutBtn").onclick = function () {
        location.href = "http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/logout.php";
    };
</script>

<style>
#EventsContainer{

    max-height: 700px;
    overflow-y: scroll;
    overflow-x:hidden;
}

#IssuesContainer{
    max-height: 700px;
    overflow-y: scroll;
    overflow-x:hidden;
}
.card {
    padding: 10px;
    margin: 10px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.4);
    transition: 0.3s;
    width: 100%;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9);
}

.eventContainer {
  padding: 2px 16px;
}

.Images{
    max-width:100%;
}

.CommentContainer{
}

</style>
</body>
</html>