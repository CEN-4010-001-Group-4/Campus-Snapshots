<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true){
    header("location: login.php");
    exit;
}


?>
 

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Campus Snapshots Admin</title>

    <!--Bootstrap CSS Core-->
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

    <?php
    include 'functions.php';
    ?>
    

    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Campus Snapshots Admin</h1>
                
            </div>
            <div class="col-6">
                <button type="submit" name="hostEventBtn" id="hostEventBtn" class="btn btn-primary">Host Event</button>
                <button type="submit" name="reportIssueBtn" id="reportIssueBtn" class="btn btn-primary">Report an Issue</button>
                <button type="submit" name="signOutBtn" id="signOutBtn" class="btn btn-danger">Log out!</button>
            </div>
        </div>
    </div>

    <div class = "container">
        <div class = "row">
            <div class = "col-6">
                <h3>Events happening around campus</h3>
            </div>
            <div class = "col-6">
                <h3>Reported incidents</h3>
            </div>
        </div>
        <div class ="row">
            <div class = "col-6" id="EventsContainer">
                <?php
                    DisplayEventsAdmin(); /*Displays the table with the events*/
                ?>
            </div>
            <div class = "col-6" id="IssuesContainer">
                <?php
                    DisplayIssuesAdmin(); /*Displays the table with issues reported*/
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
</script>

<style>
#EventsContainer{

    max-height: 600px;
    overflow-y: scroll;
    overflow-x:hidden;
}

#IssuesContainer{
    max-height: 600px;
    overflow-y: scroll;
    overflow-x:hidden;
}
#EventsReportedContainer{

max-height: 600px;
overflow-y: scroll;
overflow-x:hidden;
}

#IssuesReportedContainer{
max-height: 600px;
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