<?php
//Checks if there is an open session
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

/*Listener for the comment of event and adds it to the corresponding event*/
if (isset($_POST['eventCommentSubmit']))
{
    if(($_POST['eventComment']!=""))
    {
        $eventID = $_POST['thisEventID'];
        $username = $_SESSION['username'];
        $firstname = $_SESSION['firstname'];
        $eventComment = $_POST['eventComment'];
        InsertEventComment($eventID,$username,$firstname,$eventComment);
    }
}

/*Listener for the button to report an event*/
if (isset($_POST['eventReportSubmit']))
{
        $eventID = $_POST['thisEventID'];
        $report = 1;
        ReportEvent($eventID,$report);
}


/*Listener for admin to delete an event*/
if (isset($_POST['eventDeleteSubmit']))
{
        $eventID = $_POST['thisEventID'];
        RemoveEvent($eventID);
}

/*Listener for admin to update status of issue reported*/
if (isset($_POST['issueStatusUpdate']))
{
        $issueID = $_POST['thisIssueID'];
        $issueStatus = $_POST['thisIssueStatus'];
        UpdateIssueStatus($issueID,$issueStatus);
}

/*Listener for admin to update status of issue reported*/
if (isset($_POST['removeIssue']))
{
        $issueID = $_POST['thisIssueID'];
        RemoveIssue($issueID);
}

/*Listener for admin to update status of issue reported*/
if (isset($_POST['orderByLocation']))
{

        $_SESSION['eventBy'] = 1;
        header("Refresh:0");
}

/*Listener for admin to update status of issue reported*/
if (isset($_POST['orderByRecent']))
{
        $_SESSION['eventBy'] = 0;
        header("Refresh:0");
}


function display(){
    if($_SESSION["eventBy"] == 0){
        DisplayEvents(); /*Displays the table with the events*/
    }
    else if($_SESSION["eventBy"] == 1){
        DisplayEventsByLocation(); /*Displays the table with the events*/
    }
}

/*This function will display the events and comments*/
function DisplayEvents(){
    $i=0;
    $i2=0;
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    $reorder_query="SELECT * FROM EventsOnCampus ORDER BY eventID DESC";
    $reorder_result = $db->query($reorder_query);
        while(($row = $reorder_result->fetch_assoc()) && ($i < 10)) {
            $imageDestination = $row['eventImagePath'];
            $thisEventID = $row['eventID'];
            echo "<div class=\"card\">";
                echo "<div class = \"container\">";
                    echo"<div class =\"row\">";
                        echo"<div class = \"col-6\">";
                            echo"<img src=\"".$imageDestination."\" class=\"Images\"" . "</<img>";
                        echo"</div>";
                        echo"<div class = \"col-6\">";
                            echo"<div class=\"eventContainer\">";
                                echo"<h4><b>".$row['eventName']."</b></h4>";
                                echo"<p><b>What's happening:</b></p><p>".$row['eventDescription']."</p>";
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";
                    echo"<div class =\"row\">";
                        echo"<div class = \"col-6\">";
                            echo"<p><b>Where:</b></p><p> ".$row['eventLocation']."</p>";
                        echo"</div>";
                        echo"<div class = \"col-6\">";
                            echo"<div class=\"eventContainer\">";;
                                echo"<p><b>Time:</b></p><p>".$row['eventTime']."</p>";
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";




                    //fetches and prints all comments specific to this event
                    echo "<div class = \"CommentContainer\">";
                        echo"<div class =\"row\">";
                            echo"<div class = \"col-12\">";
                                echo"<p><b>Comments:</b></p>";
                            $reorder_query2="SELECT * FROM EventComments WHERE eventID = ".$thisEventID." ORDER BY commentID";
                            $reorder_result2 = $db->query($reorder_query2);
                            while(($row2 = $reorder_result2->fetch_assoc()) && ($i2 < 10)) {
                                echo"<p><b>".$row2['firstname'].": </b>".$row2['comment']."</p>";
                                $i2=$i2+1;
                            }
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";

                    //Displays comment box for used to enter comments
                    echo"<div class =\"row\">";
                        echo"<div class = \"col-12\">";
                            echo"<form action=\"functions.php\" method=\"post\" id=\"eventForm\" enctype=\"multipart/form-data\">";
                                echo"<div class=\"form-group\">";
                                    echo"<label for=\"comment\">Comment:</label>";
                                    //This line is needed to keep track of this eventID
                                    echo"<input type=\"text\"style=\"visibility: hidden\" name=\"thisEventID\"value=\"".$row['eventID']."\">";
                                    echo"<textarea class=\"form-control\" rows=\"1\" id=\"comment\" type=\"text\" name=\"eventComment\"></textarea>";
                                echo"</div>";
                                echo"<div class=\"form-group\">";
                                //Add a php function to add comments to a table. comment saved with this event ID key
                                    echo"<button type=\"submit\" name=\"eventCommentSubmit\" class=\"btn btn-primary\">Submit</button>";
                                    echo"<button type=\"submit\" name=\"eventReportSubmit\" class=\"btn btn-danger\" style=\"margin-left:5px;\">REPORT</button>";
                                echo"</div>";
                            echo"</form>";
                        echo"</div>";
                    echo"</div>";
                echo "</div>";
            echo"</div>";
                
            $i=$i+1; 
        }

}


/*This function will display the events and comments*/
function DisplayEventsByLocation(){
    $i=0;
    $i2=0;
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    $reorder_query="SELECT * FROM EventsOnCampus ORDER BY eventLocation";
    $reorder_result = $db->query($reorder_query);
        while(($row = $reorder_result->fetch_assoc()) && ($i < 10)) {
            $imageDestination = $row['eventImagePath'];
            $thisEventID = $row['eventID'];
            echo "<div class=\"card\">";
                echo "<div class = \"container\">";
                    echo"<div class =\"row\">";
                        echo"<div class = \"col-6\">";
                            echo"<img src=\"".$imageDestination."\" class=\"Images\"" . "</<img>";
                        echo"</div>";
                        echo"<div class = \"col-6\">";
                            echo"<div class=\"eventContainer\">";
                                echo"<h4><b>".$row['eventName']."</b></h4>";
                                echo"<p><b>What's happening:</b></p><p>".$row['eventDescription']."</p>";
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";
                    echo"<div class =\"row\">";
                        echo"<div class = \"col-6\">";
                            echo"<p><b>Where:</b></p><p> ".$row['eventLocation']."</p>";
                        echo"</div>";
                        echo"<div class = \"col-6\">";
                            echo"<div class=\"eventContainer\">";;
                                echo"<p><b>Time:</b></p><p>".$row['eventTime']."</p>";
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";




                    //fetches and prints all comments specific to this event
                    echo "<div class = \"CommentContainer\">";
                        echo"<div class =\"row\">";
                            echo"<div class = \"col-12\">";
                                echo"<p><b>Comments:</b></p>";
                            $reorder_query2="SELECT * FROM EventComments WHERE eventID = ".$thisEventID." ORDER BY commentID";
                            $reorder_result2 = $db->query($reorder_query2);
                            while(($row2 = $reorder_result2->fetch_assoc()) && ($i2 < 10)) {
                                echo"<p><b>".$row2['firstname'].": </b>".$row2['comment']."</p>";
                                $i2=$i2+1;
                            }
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";

                    //Displays comment box for used to enter comments
                    echo"<div class =\"row\">";
                        echo"<div class = \"col-12\">";
                            echo"<form action=\"functions.php\" method=\"post\" id=\"eventForm\" enctype=\"multipart/form-data\">";
                                echo"<div class=\"form-group\">";
                                    echo"<label for=\"comment\">Comment:</label>";
                                    //This line is needed to keep track of this eventID
                                    echo"<input type=\"text\"style=\"visibility: hidden\" name=\"thisEventID\"value=\"".$row['eventID']."\">";
                                    echo"<textarea class=\"form-control\" rows=\"1\" id=\"comment\" type=\"text\" name=\"eventComment\"></textarea>";
                                echo"</div>";
                                echo"<div class=\"form-group\">";
                                //Add a php function to add comments to a table. comment saved with this event ID key
                                    echo"<button type=\"submit\" name=\"eventCommentSubmit\" class=\"btn btn-primary\">Submit</button>";
                                    echo"<button type=\"submit\" name=\"eventReportSubmit\" class=\"btn btn-danger\" style=\"margin-left:5px;\">REPORT</button>";
                                echo"</div>";
                            echo"</form>";
                        echo"</div>";
                    echo"</div>";
                echo "</div>";
            echo"</div>";
                
            $i=$i+1; 
        }

}

/*This function will display the names in the IssuesOnCampus table*/
function DisplayIssues(){
    $i=0;
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    $reorder_query="SELECT * FROM IssuesOnCampus ORDER BY issueID DESC";
    $reorder_result = $db->query($reorder_query);

        while(($row = $reorder_result->fetch_assoc()) && ($i < 10)) {
            $imageDestination = $row['issueImagePath'];
            echo "<div class=\"card\">";
                echo "<div class = \"container\">";
                    echo"<div class =\"row\">";
                        echo"<div class = \"col-4\">";
                            echo"<img src=\"".$imageDestination."\" class=\"Images\"" . "</<img>";
                        echo"</div>";
                        echo"<div class = \"col-8\">";
                            echo"<div class=\"eventContainer\">";
                                echo "<h6><b>Where:</b></h6><p>" .$row['issueLocation'] . "</p>";  
                                echo "<h6><b>Description:</b></h6><p>" .$row['issueDescription'] . "</p>";
                                echo "<h6><b>Status:</b></h6><p>" .$row['issueStatus'] . "</p>";
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";
                echo "</div>";
            echo"</div>";
            $i=$i+1; 
        }

}

/*This function will display the events that have been reported*/
function DisplayEventsAdmin(){
    $i=0;
    $i2=0;
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    $reorder_query="SELECT * FROM EventsOnCampus ORDER BY eventID DESC";
    $reorder_result = $db->query($reorder_query);
        while(($row = $reorder_result->fetch_assoc()) && ($i < 10)) {
            $imageDestination = $row['eventImagePath'];
            $thisEventID = $row['eventID'];
            echo "<div class=\"card\">";
                echo "<div class = \"container\">";
                    echo"<div class =\"row\">";
                        echo"<div class = \"col-6\">";
                            echo"<img src=\"".$imageDestination."\" class=\"Images\"" . "</<img>";
                        echo"</div>";
                        echo"<div class = \"col-6\">";
                            echo"<div class=\"eventContainer\">";
                                echo"<h4><b>".$row['eventName']."</b></h4>";
                                echo"<p><b>What's happening:</b></p><p>".$row['eventDescription']."</p>";
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";
                    echo"<div class =\"row\">";
                        echo"<div class = \"col-6\">";
                            echo"<p><b>Where:</b></p><p> ".$row['eventLocation']."</p>";
                        echo"</div>";
                        echo"<div class = \"col-6\">";
                            echo"<div class=\"eventContainer\">";;
                                echo"<p><b>Time:</b></p><p>".$row['eventTime']."</p>";
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";




                    //fetches and prints all comments specific to this event
                    echo "<div class = \"CommentContainer\">";
                        echo"<div class =\"row\">";
                            echo"<div class = \"col-12\">";
                                echo"<p><b>Comments:</b></p>";
                            $reorder_query2="SELECT * FROM EventComments WHERE eventID = ".$thisEventID." ORDER BY commentID";
                            $reorder_result2 = $db->query($reorder_query2);
                            while(($row2 = $reorder_result2->fetch_assoc()) && ($i2 < 10)) {
                                echo"<p>".$row2['comment']."</p>";
                                $i2=$i2+1;
                            }
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";

                    //Displays comment box for used to enter comments
                    echo"<div class =\"row\">";
                        echo"<div class = \"col-12\">";
                            echo"<form action=\"functions.php\" method=\"post\" id=\"eventForm\" enctype=\"multipart/form-data\">";
                                echo"<div class=\"form-group\">";
                                    echo"<label for=\"comment\">Comment:</label>";
                                    //This line is needed to keep track of this eventID
                                    echo"<input type=\"text\"style=\"visibility: hidden\" name=\"thisEventID\"value=\"".$row['eventID']."\">";
                                    echo"<textarea class=\"form-control\" rows=\"1\" id=\"comment\" type=\"text\" name=\"eventComment\"></textarea>";
                                echo"</div>";
                                echo"<div class=\"form-group\">";
                                //Add a php function to add comments to a table. comment saved with this event ID key
                                    echo"<p><button type=\"submit\" name=\"eventCommentSubmit\" class=\"btn btn-primary\">Submit</button>";
                                    echo"<button type=\"submit\" name=\"eventDeleteSubmit\" class=\"btn btn-danger\" style=\"margin:5px;\">REMOVE EVENT</button>";
                                    //If this event was reported then the delete button will appear next to it
                                    if($row['eventReported']==1){
                                        echo"<b> EVENT REPORTED!</b>";
                                    }
                                    echo"</p>";
                                echo"</div>";
                            echo"</form>";
                        echo"</div>";
                    echo"</div>";
                echo "</div>";
            echo"</div>";
                
            $i=$i+1; 
        }
}

/*This function will display the names in the IssuesOnCampus table*/
function DisplayIssuesAdmin(){
    $i=0;
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    $reorder_query="SELECT * FROM IssuesOnCampus ORDER BY issueID DESC";
    $reorder_result = $db->query($reorder_query);

        while(($row = $reorder_result->fetch_assoc()) && ($i < 10)) {
            $imageDestination = $row['issueImagePath'];
            echo "<div class=\"card\">";
                echo "<div class = \"container\">";
                    echo"<div class =\"row\">";
                        echo"<div class = \"col-4\">";
                            echo"<img src=\"".$imageDestination."\" class=\"Images\"" . "</<img>";
                        echo"</div>";
                        echo"<div class = \"col-8\">";
                            echo"<div class=\"eventContainer\">";
                                echo "<h6><b>Where:</b></h6><p>" .$row['issueLocation'] . "</p>";  
                                echo "<h6><b>Description:</b></h6><p>" .$row['issueDescription'] . "</p>";
                                echo "<h6><b>Status:</b></h6><p>" .$row['issueStatus'] . "</p>";
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";

                    echo"<div class =\"row\">";
                        echo"<div class = \"col-12\">";
                            echo"<form action=\"functions.php\" method=\"post\" id=\"issueStatusUpdateForm\" enctype=\"multipart/form-data\">";
                                echo"<div class=\"form-group\">";
                                    echo"<label for=\"comment\">Update Status:</label>";
                                    //This line is needed to keep track of this issueID
                                    echo"<input type=\"text\"style=\"visibility: hidden\" name=\"thisIssueID\"value=\"".$row['issueID']."\">";
                                    echo"<textarea class=\"form-control\" rows=\"1\" id=\"comment\" type=\"text\" name=\"thisIssueStatus\"></textarea>";
                                echo"</div>";
                                echo"<div class=\"form-group\">";
                                    echo"<button type=\"submit\" name=\"issueStatusUpdate\" class=\"btn btn-primary\">Update</button>";
                                    echo"<button type=\"submit\" name=\"removeIssue\" class=\"btn btn-danger\" style=\"margin-left:5px;\">Remove</button>";
                                    echo"</div>";
                            echo"</form>";
                        echo"</div>";
                    echo"</div>";
                echo "</div>";
            echo"</div>";
            $i=$i+1; 
        }

}

/*This function will flag an event as inappopriate */
function ReportEvent($eventID,$report){
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    /*Tests that the database connects*/
    if($db->connect_errno > 0) {die('Unable to connect to database [' . $db->connect_error . ']');}
    $result = $db->query("UPDATE EventsOnCampus SET eventReported =".$report." WHERE eventID =".$eventID);
    if($result)
    {
        header("Location:http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/");
    }
    header("Location:http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/");
    $db->close();
}

/*This function is to remove an event by administration*/
function RemoveEvent($eventID){
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    /*Tests that the database connects*/
    if($db->connect_errno > 0) {die('Unable to connect to database [' . $db->connect_error . ']');}
    $result = $db->query("DELETE from EventsOnCampus WHERE eventID =".$eventID);
    if($result)
    {
        header("Location:http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/administration.php");
    }
    header("Location:http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/administration.php");
    $db->close();
}

/*This function will remove issue from database by administration*/
function RemoveIssue($issueID){
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    /*Tests that the database connects*/
    if($db->connect_errno > 0) {die('Unable to connect to database [' . $db->connect_error . ']');}
    $result = $db->query("DELETE from IssuesOnCampus WHERE  issueID =".$issueID);
    if($result)
    {
        header("Location:http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/administration.php");
    }
    header("Location:http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/administration.php");
    $db->close();
}

/*This function is to update the status of the reported issue*/
function UpdateIssueStatus($issueID,$issueStatus){
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    /*Tests that the database connects*/
    if($db->connect_errno > 0) {die('Unable to connect to database [' . $db->connect_error . ']');}
    $result = $db->query("UPDATE IssuesOnCampus SET issueStatus = '".$issueStatus."' WHERE issueID = ".$issueID);
    if($result)
    {
        header("Location:http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/administration.php");
    }

    $db->close();
}

/*Create and add new event to EventsOnCampus Table */
function InsertEvent($eventName,$eventLocation,$eventTime,$eventDescription,$fileDestination){
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    /*Tests that the database connects*/
    if($db->connect_errno > 0) {die('Unable to connect to database [' . $db->connect_error . ']');}
    $result = $db->query("INSERT INTO EventsOnCampus(eventName,eventLocation,eventTime,eventDescription,eventImagePath,eventReported) VALUES ('$eventName','$eventLocation','$eventTime','$eventDescription','$fileDestination',0)");
    if($result)
    {
        echo"Event submitted!";
    }
    $db->close();
}

/*This function inserts a comment to the table*/
function InsertEventComment($eventID,$username,$firstname,$comment){
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    /*Tests that the database connects*/
    if($db->connect_errno > 0) {die('Unable to connect to database [' . $db->connect_error . ']');}

    
    $result = $db->query("INSERT INTO EventComments(eventID,username,firstname,comment) VALUES ('$eventID','$username','$firstname','$comment')");
    
    if($result)
    {
        header("Location:http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/welcome.php");
    }
    $db->close();
}

/*Create and add new issue to EventsOnCampus Table */
function InsertIssue($issueLocation,$issueDescription,$fileDestination){
    include '../Login/Login.php';
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    /*Tests that the database connects*/
    if($db->connect_errno > 0) {die('Unable to connect to database [' . $db->connect_error . ']');}
    $result = $db->query("INSERT INTO IssuesOnCampus(issueStatus,issueLocation,issueDescription,issueImagePath) VALUES ('Pending...','$issueLocation','$issueDescription','$fileDestination')");
    if($result)
        {
            echo"Issue reported!";
        }
    $db->close();
}


?>