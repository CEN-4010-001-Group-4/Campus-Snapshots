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
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Host an Event</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
    
    <button type="submit" name="home" id="home" class="btn btn-primary">Home</button>
    <div class="card">
        <div class="card-header">
            <h1>Host An Event!</h1>
            <p>Fill out the information below to host your event!</p>
        </div>
        <div class="card-body">
            <div class="container" >
                <div class ="row">
                    <div class="col-12">
                        <form action="" method="post" id="eventForm" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="eventName">Event Name:</label>
                                <input type="text" class="form-control" id="eventName" name="eventName" placeholder="Enter event name...">
                            </div>

                            <div class="form-group">
                                <label for="eventLocation">Location</label>
                                <select name="eventLocation" class="custom-select mb-3" name="eventLocation">
                                    <option value="BARRY KAYE HALL" selected>BARRY KAYE HALL</option>
                                    <option value="BASEBALL STADIUM">BASEBALL STADIUM</option>
                                    <option value="BEHAVIORAL SCIENCES BUILDING">BEHAVIORAL SCIENCES BUILDING</option>
                                    <option value="BOOKSTORE">BOOKSTORE</option>
                                    <option value="COMPUTER CENTER">COMPUTER CENTER</option>
                                    <option value="COLLEGE FOR DESIGN & SOCIAL INQUIRY">COLLEGE FOR DESIGN & SOCIAL INQUIRY</option>
                                    <option value="COLLEGE OF ARTS & LETTERS">COLLEGE OF ARTS & LETTERS</option>
                                    <option value="COLLEGE OF BUSINESS">COLLEGE OF BUSINESS</option>
                                    <option value="COLLEGE OF EDUCATION">COLLEGE OF EDUCATION</option>
                                    <option value="COLLEGE OF ENGINEERING AND COMPUTER SCIENCE">COLLEGE OF ENGINEERING AND COMPUTER SCIENCE</option>
                                    <option value="COLLEGE OF MEDICINE">COLLEGE OF MEDICINE,</option>
                                    <option value="COLLEGE OF NURSING">COLLEGE OF NURSING</option>
                                    <option value="COLLEGE OF SCIENCE">COLLEGE OF SCIENCE</option>
                                    <option value="CULTURE AND SOCIETY BUILDING">CULTURE AND SOCIETY BUILDING</option>
                                    <option value="DOROTHY F. SCHMIDT ARTS & HUMANITIES">DOROTHY F. SCHMIDT ARTS & HUMANITIES</option>
                                    <option value="DOROTHY F. SCHMIDT PERFORMING ARTS CENTER">DOROTHY F. SCHMIDT PERFORMING ARTS CENTER</option>
                                    <option value="DOROTHY F. SCHMIDT VISUAL ARTS CENTER">DOROTHY F. SCHMIDT VISUAL ARTS CENTER</option>
                                    <option value="ENGINEERING EAST">ENGINEERING EAST</option>
                                    <option value="ENGINEERING WEST">ENGINEERING WEST</option>
                                    <option value="FAU STADIUM">FAU STADIUM</option>
                                    <option value="FLEMING HALL">FLEMING HALL</option>
                                    <option value="GENERAL CLASSROOM - NORTH">GENERAL CLASSROOM - NORTH</option>
                                    <option value="GENERAL CLASSROOM - SOUTH">GENERAL CLASSROOM - SOUTH</option>
                                    <option value="GLADES PARK TOWERS">GLADES PARK TOWERS</option>
                                    <option value="HERITAGE PARK TOWERS">HERITAGE PARK TOWERS</option>
                                    <option value="INDIAN RIVER TOWERS">INDIAN RIVER TOWERS</option>
                                    <option value="INNOVATION VILLAGE APARTMENTS - NORTH">INNOVATION VILLAGE APARTMENTS - NORTH</option>
                                    <option value="INNOVATION VILLAGE APARTMENTS - SOUTH">INNOVATION VILLAGE APARTMENTS - SOUTH</option>
                                    <option value="LIVE OAK PAVILION">LIVE OAK PAVILION</option>
                                    <option value="LIVING ROOM THEATER">LIVING ROOM THEATER</option>
                                    <option value="MEMORY & WELLNESS CENTER">MEMORY & WELLNESS CENTER</option>
                                    <option value="PARKING GARAGE I">PARKING GARAGE I</option>
                                    <option value="PARKING GARAGE II">PARKING GARAGE II</option>
                                    <option value="PARKING GARAGE III">PARKING GARAGE III</option>
                                    <option value="PARLIAMENT HALL">PARLIAMENT HALL</option>
                                    <option value="PHIL SMITH HALL">PHIL SMITH HALL</option>
                                    <option value="RECREATION AND FITNESS CENTER">RECREATION AND FITNESS CENTER</option>
                                    <option value="RITTER ART GALLERY">RITTER ART GALLERY</option>
                                    <option value="S.E. WIMBERLY LIBRARY">S.E. WIMBERLY LIBRARY</option>
                                    <option value="SCIENCE BUILDING">SCIENCE BUILDING</option>
                                    <option value="SOCIAL SCIENCE BUILDING">SOCIAL SCIENCE BUILDING</option>
                                    <option value="SOFTBALL STADIUM">SOFTBALL STADIUM</option>
                                    <option value="STUDENT HEALTH SERVICES">STUDENT HEALTH SERVICES</option>
                                    <option value="STUDENT HOUSING OFFICES">STUDENT HOUSING OFFICES</option>
                                    <option value="STUDENT SERVICES & CAFETERIA">STUDENT SERVICES & CAFETERIA</option>
                                    <option value="STUDENT SUPPORT SERVICES">STUDENT SUPPORT SERVICES</option>
                                    <option value="STUDENT UNION">STUDENT UNION</option>
                                    <option value="UNIVERSITY VILLAGE STUDENT APARTMENTS">UNIVERSITY VILLAGE STUDENT APARTMENTS</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="eventTime">Time:</label>
                                <div class="container" id="eventTime">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <select name="eventTimeHour" class="custom-select">
                                                <option selected value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-2">
                                            <select name="eventTimeMinute" class="custom-select">
                                                <option selected value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <select name="eventPeriod" class="custom-select">
                                                <option selected value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="eventDescription">Description:</label>
                                <input type="text" class="form-control" id="eventDescription" name="eventDescription" placeholder="Describe your event...">
                            </div>

                            <div class="custom-file">
                                <input type="file" name="eventImage" class="custom-file-input" id="eventImage">
                                <label class="custom-file-label" for="eventImage">Choose Image...</label>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="eventSubmit" class="btn btn-danger" style="margin: 5px;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

        if (isset($_POST['eventSubmit']))
        {
            $MAX = 100000;
            if(($_POST['eventName']!="") && ($_POST['eventDescription']!=""))
            {


                $file = $_FILES['eventImage'];

                $fileName = $_FILES['eventImage']['name'];
                $fileTmpName = $_FILES['eventImage']['tmp_name'];
                $fileSize = $_FILES['eventImage']['size'];
                $fileError = $_FILES['eventImage']['error'];
                $fileType = $_FILES['eventImage']['type'];

                $fileExt = explode('.',$fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array('jpg','jpeg','png');

                if(in_array($fileActualExt,$allowed)){
                    if($fileError===0){
                        if($fileSize < $MAX){
                            $fileNameNew = uniqid('',true).".".$fileActualExt;
                            $fileDestination = 'EventsImages/'.$fileNameNew;

                            move_uploaded_file($fileTmpName,$fileDestination);


                            $eventName = $_POST['eventName'];
                            $eventLocation = $_POST['eventLocation'];
                            $eventTimeHour = $_POST['eventTimeHour'];
                            $eventTimeMinute = $_POST['eventTimeMinute'];
                            $eventPeriod = $_POST['eventPeriod'];
                            $eventDescription = $_POST['eventDescription'];
                            $eventTime = $eventTimeHour.":".$eventTimeMinute." ".$eventPeriod;


                            InsertEvent($eventName,$eventLocation,$eventTime,$eventDescription,$fileDestination);
                        }else{
                            echo("Image is too large! Must be less than 10Mb!");
                        }
                    }else{
                        echo("Error.. try again");
                    }
                }else{
                    echo("File type not accepted!");
                }
            }
            else{echo("Please fill out the missing fields!");}
           
        }
    ?>

<script>
        // The name of the file appears on the upload field
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        document.getElementById("home").onclick = function () {
            location.href = "http://lamp.cse.fau.edu/~cen4010fal19_g04/CampusSnapshot/welcome.php";
        };
</script>

<style>
    .card{
        font-weight: bold;
        margin-left: 25%;
        width:50%;
    }
    .card-header{
        color: white;
        background: #d9534f;
    }
    .card-body{
    }
</style>

</body>


</html>