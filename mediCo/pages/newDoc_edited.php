<?php include '../server/new_doc.php' ?>
<?php include '../server/update_doctor.php' ?>
<?php include '../server/availability.php' ?>

<?php 
     $user_id = htmlspecialchars($_GET["id"]);
?>

<?php 
    session_start();

//db connection
$db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

    if(!isset($_SESSION['email'])){
        $_SESSION['msg'] = "You need to login, no hackers here mate!";
        header('location: login.php');
    }

    if(isset($_SESSION['email'])){

        $check_query="SELECT * FROM Doctors WHERE id='$user_id' LIMIT 1";
        $result=mysqli_query($db, $check_query);
        //target the user profile key value pair
        $user = mysqli_fetch_assoc($result);

        $userProfile=$user['profile'];
        $firstname=$user['firstname'];
        $surname=$user['surname'];
        $specialisation=$user['specialisation'];
        $email=$user['email'];
        $number=$user['number'];
        $doctorID=$user['doctorID'];
        $room=$user['room'];
        $profile=$user['profile'];

        //echo $userProfile;
    }

    //getting default doctor id
    $check_doctor_id="SELECT id FROM Doctors ORDER BY id ASC LIMIT 1;";
    $check_result=mysqli_query($db, $check_doctor_id);
    $user = mysqli_fetch_assoc($check_result);
    $send_id=$user['id'];

    //getting default patient id
    $check_patient_id="SELECT id FROM Patients ORDER BY id ASC LIMIT 1;";
    $check_result2=mysqli_query($db, $check_patient_id);
    $user2 = mysqli_fetch_assoc($check_result2);
    $send_id2=$user2['id'];


?>

<!DOCTYPE html>
<html lang="eng-US">
    <head>
    <meta name="subject" content="IDV200">
    <meta name="Lecturer" content="Mike Maynard">
    <meta name="StudentNumber" content="200080">
    <meta name="StudentName" content="Isla Just">
    <meta name="Assessment" content="Term3 project">
    <meta charset="utf-8">

    <title>MediCo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>

    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/new.css">

    <!--link font selection - choose font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;0,900;1,700&display=swap" rel="stylesheet">
    
    </head>

    <body>
        <div class='container-fluid'>
            <div class='vert-nav'>

                <div class="logo"><img src="../assets/logo2.svg" height="40px"></div>


                <a href="../pages/landing.php"><div class="home"><img src="../assets/Group 8.svg"  width= "27px"></img></div></a>
                <a href="../pages/profile.php"><div class="profile"><img src="../assets/Group 11.svg"  width= "25px"></img></div></a>
                <a href="../pages/new.php"><div class="new"><img src="../assets/Group 12.svg"  width= "25px"></img></div></a>

                <div class="bloop"><img src="../assets/bloop.svg"></img></div>

               <a href="../server/logout.php"> <div class="exit"><img src="../assets/Group 9.svg"  width= "25px"></img></div></a>

            </div>
            <div class="main-card">
                <div class="section1">
                    <div class="slider-container">
                       <div class="slider">New doctor profile</div>

                       <a href=<?php echo "../pages/newPatient.php?id=" . $send_id2 . ""?>><p style="text-align: right; margin-top: -30px; margin-right: 20px;">New patient profile</p></a>
                    </div>

                    <h5 class="schedule">Add a doctor</h5>
                    <div class="addBlock">

                    <form enctype="multipart/form-data" action= <?php echo "newDoc.php?id=" . $send_id . ""?> method="post">
                   
                        <div class='Half1'>
                        <div class="input-labels2">First name</div>  
                         <div class="input-labels2" style="margin-left: 10%;">Surname</div>
                         <input class="newDoc"  name="firstname" required>
                         <input class="newDoc"style="margin-left: 5.5%;"  name="surname" required>

                         <div class="input-labels2">Email</div>  
                         <div class="input-labels2" style="margin-left: 10%;">Telephone</div>
                         <input class="newDoc"  name="email" required>
                         <input class="newDoc"style="margin-left: 5.5%;"  name="number" required>


                         <div class="input-labels2">Doctor ID</div>  
                         <div class="input-labels2" style="margin-left: 10%;">Gender</div>
                         <input class="newDoc"  name="doctorID" required>
                         <input class="newDoc"style="margin-left: 5.5%;"  name="gender" required>
                    
                        </div>
                        
                        <div class="lineH"></div>

                        <div class='Half2'>
                            <div class="input-labels2">Specialisation</div>  
                            <div class="input-labels2" style="margin-left: 10%;">Room</div>
                            <input class="newDoc"  name="specialisation" required>
                            <input class="newDoc"style="margin-left: 5.5%;"  name="room" required>

                            <div class="input-labels2">Date of birth</div>  
                            <div class="input-labels2" style="margin-left: 10%;">Add profile picture</div>  

                            <input class="newDoc" type="Date" name="dob" required>

                            <input  id="custom-file-input"type="file" name="profileImage">

                            <div class="errorBlock">

                            <?php include '../server/error.php' ?>
                            </div>

                            <button type="submit" class="newDocSubmit" name="add_doc">Add Doctor</button>
                          
                        </div>
                    </form>

                    </div><!--add block-->

                    <h5 class="schedule">Registered doctors</h5>
                    <div class="titles" style='margin-left:10px'>Name</div>
                    <div class="titles" style="margin-left: 130px">Specialisation</div>
                    <div class="titles" style="margin-left: 60px">Doctor ID</div>
                    <div class="titles" style="margin-left: 50px">Gender</div>
                    <div class="titles" style="margin-left: -20px">Room</div>

                    <div class="appointments">

                    <?php include '../server/show_doc.php' ?>    
               
                                  
                </div><!--appointments-->
                </div><!--section1 -->
                <div class="section2">
                    <h5 style="margin-top: -20px; text-align: center; margin-left: 0px; margin-bottom: 20px;">Active profile</h5>
                    <div class="empty-profile-pic"><img src="../profiles/<?php echo $profile?>"></img></div>
                    <h2><?php echo $firstname . " " . $surname?></h2>
                    <p><?php echo $specialisation?></p>

                    <form enctype="multipart/form-data" method="post">
                    
                    <h5>Edit details</h5>
                    <div class="input-labels">First name</div>   <div class="input-labels" style="margin-left: 4%;">Surname</div>
                    <input class="newBooking" value="<?php echo $firstname?>" name="firstname" required>
                    
                  
                    <input class="newBooking" value="<?php echo $surname?>" style="margin-left: 4%;" name="surname" required>

                    <div class="input-labels">Email</div>   <div class="input-labels" style="margin-left: 4%;">Telephone</div>
                    <input class="newBooking" value="<?php echo $email?>" name="email" required>
                    <input class="newBooking" value="<?php echo $number?>" style="margin-left: 4%;" name="number" required>


                    <div class="input-labels">DoctorID</div>   <div class="input-labels" style="margin-left: 4%;">Specialisation</div>
                    <input class="newBooking" value="<?php echo $doctorID?>"  name="doctorID" required>
                    <input class="newBooking" value="<?php echo $specialisation?>" style="margin-left: 4%" name="specialisation" required>

                    <div class="input-labels">Room</div>   <div class="input-labels" style="margin-left: 4%;">Profile</div>
                    <input class="newBooking" value="<?php echo $room?>" name="room" required style="margin-bottom:20px; float:left;">
                    <input class="newBooking" type="file" style="margin-left: 4%; margin-bottom:10px; float:left;" name="profileImage">

                    <div class="errorBlock3">
                        <?php include '../server/error2.php'?>
                    </div>

                        <button class="checkBtn" type="submit" style="margin-left:27%; margin-top:5px" name="update_doctor">Update doctor info</button>
            

                        <h5 style="margin-top:17px">Availability</h5>

                      

                        <div class="scale">
                            <div class="progress"></div>
                        </div>
                        <div class="input-labels" style="margin-left: 40px;">Available</div>   <div class="input-labels" style="margin-left: 4%; text-align: right;">Fully booked</div>
                </div><!--section2-->
            </div><!--main card-->
        </div>


        <div class="popup">
            <div class="sure">
                <a href="../pages/newDoc.php?id=<?php echo $send_id?> "><div class="cancel"><img src="../assets/close.png" style="width:20px; float:right"></img></div></a>

            <h3>Dr. <?php echo $surname?>'s data has been edited</h3>
            <p style="margin-top:15px"><strong><?php echo $specialisation?><br></strong><?php echo $firstname. " ".  $surname?></p>
            <div class="illustration2"></div>
            </div>
        </div>
        <script>

        </script>
    </body>
</html>