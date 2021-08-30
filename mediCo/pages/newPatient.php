<?php include '../server/new_patient.php' ?>
<?php include '../server/update_patient.php' ?>

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

    $email = $_SESSION['email'];
    $check_query2="SELECT * FROM Receptionist WHERE email='$email' LIMIT 1";
    $result2=mysqli_query($db, $check_query2);
    //target the user profile key value pair
    $user2 = mysqli_fetch_assoc($result2);
    $rec_id=$user2['id'];
    
    $check_query="SELECT * FROM Patients WHERE id='$user_id' LIMIT 1";
    $result=mysqli_query($db, $check_query);
    //target the user profile key value pair
    $user = mysqli_fetch_assoc($result);

    $userProfile=$user['profile'];
    $firstname=$user['firstname'];
    $surname=$user['surname'];
    $medicalAid=$user['medicalAid'];
    $email1=$user['email'];
    $number=$user['number'];
    $patientID=$user['patientID'];
    $profile=$user['profile'];

    $gender=$user['gender'];

    //echo $userProfile;
}
//getting default doctor id
    $check_id="SELECT id FROM Doctors ORDER BY id ASC LIMIT 1;";
    $check_result=mysqli_query($db, $check_id);
    $user1 = mysqli_fetch_assoc($check_result);
    $send_id=$user1['id'];

    //getting default patient id
    $check_patient_id="SELECT id FROM Patients ORDER BY id ASC LIMIT 1;";
    $check_result2=mysqli_query($db, $check_patient_id);
    $user = mysqli_fetch_assoc($check_result2);
    $send_id2=$user['id'];
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
                <a href="../pages/profile.php?id=<?php echo $rec_id?>"><div class="profile"><img src="../assets/Group 11.svg"  width= "25px"></img></div></a>
                <a href="../pages/newDoc.php"><div class="new"><img src="../assets/Group 12.svg"  width= "25px"></img></div></a>

                <div class="bloop"><img src="../assets/bloop.svg"></img></div>

               <a href="../server/logout.php"> <div class="exit"><img src="../assets/Group 9.svg"  width= "25px"></img></div></a>

            </div>
            <div class="main-card">
                <div class="section1">
                    <div class="slider-container">
                        <div class="slider" style="margin-right:0px; float:right">New Patient profile</div>
                        <a href=<?php echo "../pages/newDoc.php?id=" . $send_id . ""?>><p style="text-align: left; margin-left: 15px; margin-top:10px;">New Doctor profile</p></a>
                    </div>

                    <h5 class="schedule">Add a patient</h5>
                    <div class="addBlock">

                    <form enctype="multipart/form-data" action= <?php echo "newPatient.php?id=" . $send_id2 . ""?> method="post">
                   
                        <div class='Half1'>
                        <div class="input-labels2">First name</div>  
                         <div class="input-labels2" style="margin-left: 10%;">Surname</div>
                         <input class="newDoc" name="firstname" required>
                         <input class="newDoc"style="margin-left: 5.5%;" name="surname" required>

                         <div class="input-labels2">Email</div>  
                         <div class="input-labels2" style="margin-left: 10%;">Telephone</div>
                         <input class="newDoc" name="email" type="email" required>
                         <input class="newDoc"style="margin-left: 5.5%;" name="number" type="tel" pattern=".{10,}" title="A phone number is at least 10 characters" required>


                         <div class="input-labels2">Date of birth</div>  
                         <div class="input-labels2" style="margin-left: 10%;">Gender</div>
                         <input class="newDoc" type="Date" name="dob" required>
                         <input class="newDoc"style="margin-left: 5.5%;" name="gender" required>
                    
                        </div>
                        
                        <div class="lineH"></div>

                        <div class='Half2'>
                            <div class="input-labels2">Patient ID</div>  
                            <div class="input-labels2" style="margin-left: 10%;">Medical aid number</div>
                            <input class="newDoc" name="patientID" pattern=".{10,}" title="A patient ID is at least 10 characters"required>
                            <input class="newDoc"style="margin-left: 5.5%;" name="medicalAid" pattern=".{10,}" title="A decical AID is at least 10 characters"required>

                            <div class="input-labels2">Add profile picture</div>  
                         

                <input  id="custom-file-input2"type="file" name="profile">


                            <div class="errorBlock2">
                            <?php include '../server/error.php' ?>
                            </div>

                            <button class="newDocSubmit" type="submit" style="margin-top:30px" name="add_patient">Add Patient</button>
                          
                        </div>
                        </form>

                    </div><!--add block-->

                    <h5 class="schedule">List of patients</h5>

                    <div class="titles" style='margin-left:10px'>Name</div>
                    <div class="titles" style="margin-left: 130px">Medical Aid</div>
                    <div class="titles" style="margin-left: 60px">Patient ID</div>
                    <div class="titles" style="margin-left: 50px">Gender</div>
                    <div class="titles" style="margin-left: -20px">Telephone</div>

                    <div class="appointments">

                    <?php include '../server/show_patient.php' ?>
               
                                  
                </div><!--appointments-->
                </div><!--section1 -->
                <div class="section2">
                    <h5 style="margin-top: 20px; text-align: center; margin-left: 0px; margin-bottom: 20px;">Active profile</h5>
                    <div class="empty-profile-pic"><img src="../profiles/<?php echo $profile?>"></img></div>
                    <h2><?php echo $firstname . " " . $surname?></h2>
                    <p><?php echo $email1?></p>
                    
                    <form enctype="multipart/form-data" method="post">

                    <h5 style="margin-top:50px;">Edit details</h5>
                    <div class="input-labels">First name</div>   <div class="input-labels" style="margin-left: 4%;">Surname</div>
                    <input class="newBooking" value="<?php echo $firstname?>" name="firstname" required>
                    
                  
                    <input class="newBooking" value="<?php echo $surname?>" style="margin-left: 4%;" name="surname" required>

                    <div class="input-labels">Email</div>   <div class="input-labels" style="margin-left: 4%;">Telephone</div>
                    <input class="newBooking" value="<?php echo $email1?>" name="email" required>
                    <input class="newBooking" value="<?php echo $number?>" style="margin-left: 4%;" name="number" required>


                    <div class="input-labels">Patient ID</div>   <div class="input-labels" style="margin-left: 4%;">Medical Aid</div>
                    <input class="newBooking" value="<?php echo $patientID?>"  name="patientID" required>
                    <input class="newBooking" value="<?php echo $medicalAid?>" style="margin-left: 4%" name="medicalAid" required>

                    <div class="input-labels">Gender</div>   <div class="input-labels" style="margin-left: 4%;">Profile picture</div>
                    <input class="newBooking" value="<?php echo $gender?>" name="gender" required style="margin-bottom:20px; float:left;">
                    <input  id="custom-file-input3" type="file" name="profileImage">


                    <div class="errorBlock3">
                        <?php include '../server/error2.php'?>
                    </div>

                    <button class="checkBtn" type="submit" style="margin-left:27%; margin-top:5px" name="update_patient">Update patient info</button>
                    </form>

                   
                </div><!--section2-->
            </div><!--main card-->
        </div>
        <script>

        </script>
    </body>
</html>