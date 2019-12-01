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
    <title>Report an Issue</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--Bootstrap CSS Core-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>
<body>

    <?php
    include 'functions.php';
    ?>
    
    <button type="submit" name="home" id="home" class="btn btn-danger">Home</button>

    <div class="card">
        <div class="card-header">                
            <h1>Report an Issue</h1>
            <p>Fill out the information below to report an issue</p>
        </div>

        <div class="card-body">
            <div class="container">
                <div class = "row">
                    <div class="col-12">
                        <form action="" method="post" id="issueForm" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="issueLocation">Location</label>
                                <select name="issueLocation" class="custom-select mb-3" name="issueLocation">
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
                                <label for="issueDescription">Description:</label>
                                <input type="text" class="form-control" id="issueDescription" name="issueDescription" placeholder="Describe the issue...">
                            </div>

                            <div class="custom-file">
                                <input type="file" name="issueImage" class="custom-file-input" id="issueImage">
                                <label class="custom-file-label" for="issueImage">Choose Image...</label>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="issueSubmit" class="btn btn-primary" style="margin-top:10px;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php

        if (isset($_POST['issueSubmit']))
        {
            $MAX = 100000;
            if(($_POST['issueDescription']!=""))
            {


                $file = $_FILES['issueImage'];

                $fileName = $_FILES['issueImage']['name'];
                $fileTmpName = $_FILES['issueImage']['tmp_name'];
                $fileSize = $_FILES['issueImage']['size'];
                $fileError = $_FILES['issueImage']['error'];
                $fileType = $_FILES['issueImage']['type'];

                $fileExt = explode('.',$fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array('jpg','jpeg','png');

                if(in_array($fileActualExt,$allowed)){
                    if($fileError===0){
                        if($fileSize < $MAX){
                            $fileNameNew = uniqid('',true).".".$fileActualExt;
                            $fileDestination = 'IssuesImages/'.$fileNameNew;

                            move_uploaded_file($fileTmpName,$fileDestination);

                            $issueLocation = $_POST['issueLocation'];
                            $issueDescription = $_POST['issueDescription'];

                            InsertIssue($issueLocation,$issueDescription,$fileDestination);
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


</body>
</html>

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
        background: #0275d8;
    }
    .card-body{
    }
</style>