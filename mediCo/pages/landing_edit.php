<?php include '../server/new_appointment.php' ?>
<?php include '../server/update_appointment.php' ?>

<?php 
    session_start();


   $appointment_id = htmlspecialchars($_GET["id"]);

//db connection
$db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

    if(!isset($_SESSION['email'])){
        $_SESSION['msg'] = "You need to login, no hackers here mate!";
        header('location: login.php');
    }

    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $check_query="SELECT * FROM Receptionist WHERE email='$email' LIMIT 1";
        $result=mysqli_query($db, $check_query);
        //target the user profile key value pair
        $user = mysqli_fetch_assoc($result);

        $userProfile=$user['profile'];
        $firstName=$user['firstname'];
        $surname=$user['surname'];
        $rank=$user['rank'];
        $id=$user['id'];

        //echo $userProfile;

    }

    $check_id="SELECT id FROM Appointments ORDER BY id ASC LIMIT 1;";
    $check_result=mysqli_query($db, $check_id);
    $user1 = mysqli_fetch_assoc($check_result);
    $send_id=$user1['id'];

    //getting appointment details
    $appointment_details="SELECT * FROM Appointments WHERE id = '$appointment_id'";
    $appointment_result=mysqli_query($db, $appointment_details);
    $appointment = mysqli_fetch_assoc($appointment_result);
    
    $doctor=$appointment['doctor'];
    $patient=$appointment['patient'];
    $date=$appointment['date'];
    $time=$appointment['time'];
    $room=$appointment['room'];
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
    <link rel="stylesheet" href="../css/main.css">

    <!--link font selection - choose font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;0,900;1,700&display=swap" rel="stylesheet">
    
    </head>

    <body>
        <div class='container-fluid'>
            <div class='vert-nav'>

                <div class="logo"><img src="../assets/logo2.svg" height="40px"></div>

                <div class="home"><img src="../assets/Group 8.svg"  width= "27px"></img></div>
                <?php if(isset($_SESSION['email'])) : ?>
                <a href= <?php echo "../pages/profile.php?id=" . $id . ""?>><div class="profile"><img src="../assets/Group 11.svg"  width= "25px"></img></div></a>
          
                <a href= <?php echo "../pages/newDoc.php?id=" . $send_id . ""?>><div class="profile"><img src="../assets/Group 12.svg"  width= "25px"></img></div></a> 
     <?php endif ?>
                <div class="bloop"><img src="../assets/bloop.svg"></img></div>

               <a href="../server/logout.php"> <div class="exit"><img src="../assets/Group 9.svg"  width= "25px"></img></div></a>

            </div>
            <div class="main-card">
                <div class="section1">
                <form method="post" enctype="multipart/form-data">  
                    <input class="search" name="search" placeholder="Search a date" required>
                    
                    <button class="search-container" type="submit" name="submit_search" ><img src="../assets/search.svg" width="18px"></img></button>
           
                    </form>

                    <div class="goodMorningBlock">

                    <?php if(isset($_SESSION['email'])) : ?>
                    <h1>Good morning,  <strong><?php echo $firstName ?></strong></h1>
                     <?php endif ?>
                     
                        <p>Have a great day at work!</p>
                    </div><!--good morning block-->

                    <h5 class="schedule">Scheduled Appointments</h5>
                    <div class="titles">Patient</div>
                    <div class="titles">Doctor</div>
                    <div class="titles">Date</div>
                    <div class="titles">Time</div>
                    <div class="titles">Room</div>

                    <div class="appointments">

                    <?php include '../server/show_appointments.php' ?>
                                  
                </div><!--appointments-->
                </div><!--section1 -->
                <div class="section2">

                <?php if(isset($_SESSION['email'])) : ?>
                    <div class="empty-profile-pic">
                        <img src="../profiles/<?php echo $userProfile ?>" style="width:170px; height:170px; border-radius:50%"></img>
                    </div>

                        <h2><?php echo $firstName . ' ' . $surname ?></h2>
                        <p><?php echo $rank?></p>

                <?php endif ?>

                    <h5>Weekly overview</h5>
                    <div class="overviewRow">
                        <div class="dateBlock">
                            Mon
                            <div class="dateNo">12</div>
                            <div class="dots-row">
                                <div class="dot"></div>
                            </div>
                        </div>
                        <div class="dateBlock activeDate">
  
                                Tue
                                <div class="dateNo">13</div>
                                <div class="dots-row">
                                    <div class="dot"></div>
                                </div>
                        </div>
                        <div class="dateBlock">
                      
                                Wed
                                <div class="dateNo">14</div>
                                <div class="dots-row">
                                  
                                </div>
                        </div>
                        <div class="dateBlock">
                      
                                Thur
                                <div class="dateNo">15</div>
                                <div class="dots-row">
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                </div>
                        </div>
                        <div class="dateBlock">
                    
                                Fri
                                <div class="dateNo">16</div>
                                <div class="dots-row">
                                    <div class="dot"></div>
                                </div>
                        </div>
                        <div class="dateBlock">
                    
                                Sat
                                <div class="dateNo">17</div>
                                <div class="dots-row">
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                </div>
                        </div>
                        <div class="dateBlock">
                
                                Sun
                                <div class="dateNo">18</div>
                                <div class="dots-row">
                                    <div class="dot"></div>
                                </div>
                        </div>
                    </div><!--overview row-->

                    <h5>New Booking</h5>  
                      <form enctype="multipart/form-data" method="POST" action="landing.php">
                    <div class="booking-block">
                    
                        <select class="patSelect" value="Patient" name="patient" required>
                            <option value="select a patient" disabled selected>Select a patient</option>
                            <?php include "../server/patient_dropdown.php"?>
                        </select>
                        <select class="docSelect" value="Doctor" style="margin-left: 4%;" name="doctor" required>
                        <option value="select a doctor" disabled selected>Select a doctor</option>
                        <?php include "../server/doctor_dropdown.php"?>
                        </select>

                        <input class="newBooking" placeholder="Date" style="margin-top: 20px;" type="date" name="date" required>
                        <input class="newBooking" placeholder="Time" style="margin-left: 4%; margin-top: 20px;" type="time" name="time" required>

                        <input class="newBooking" placeholder="Room" style="margin-top: 20px; margin-bottom: 30px;" name="room" required>
                        <div class="errorBlock">

                    <?php include '../server/error.php' ?>

                        </div>

                        <button class="checkBtn" type="submit" name="add_appointment">Check availability</button>
                </form>

                    </div><!--booking block-->
                </div><!--section2-->
            </div><!--main card-->
        </div>
        
        <div class="popup">
            <div class="sure">
                <a href="../pages/landing.php?id=<?php echo $send_id?> "><div class="cancel"><img src="../assets/close.png" style="width:20px; float:right"></img></div></a>

            <h3>Edit appointment</h3>
            <form enctype="multipart/form-data" method="POST">

            <select class="patSelect" value="<?php echo $patient?>" name="patient" style='width:100%; margin-top: 20px;'required>
                            <option value="<?php echo $patient?>"><?php echo $patient?></option>
                            <?php include "../server/patient_dropdown.php"?>
                        </select>
                        <select class="docSelect" value="<?php echo $doctor?>" style='width:100%; margin-top: 20px;' name="doctor" required>
                        <option value="<?php echo $doctor?>"><?php echo $doctor?></option>
                        <?php include "../server/doctor_dropdown.php"?>
                        </select>

                        <input class="newBooking" value="<?php echo $date?>" placeholder="Date" style="margin-top: 20px; width:100%" type="date" name="date" required>
                        <input class="newBooking" value="<?php echo $time?>" placeholder="Time" style="margin-top: 20px;" type="time" name="time" required>

                        <input class="newBooking" value="<?php echo $room?>" style="margin-top: 20px; margin-left: 6%; " name="room" required>
                        <div class="errorBlock" style="width:100%; font-size:12px; margin-top:10px; text-align:center; margin-left:0;">
                        <?php include '../server/error.php' ?>
                </div>

                    <button class="checkBtn" style='width:80%;margin-left:10%'type="submit" name="update_appointment">Make changes</button>
                    <p style="margin-top:10px; font-size:12px">Please notify both parties of the changes made</p>
                        </form>

            </div>
        </div>
        <script>

            //the jquery that doesnt work
                                    // $(".delete").hide();
                                    // $(".edit").hide();
                                    // $(".popup").hide();


// $(".appointment").on("click", function(){

//         $(".appointment").removeClass("activeAppointment");
//             $(this).toggleClass("activeAppointment");
//             $(".edit").hide();
//             $(this).find(".edit").show();

//             $(".delete").hide();
//             $(this).find(".delete").show();
//     });

// $(".cancel").on("click", function(){
//     $(".popup").fadeOut(300);
// })

// $(".delete").on("click", function(){
//    $(".popup").fadeIn();
//    var idValue=$(this).find(".appointment").attr("value");
//    console.log(idValue);
// })


// $(".activeAppointment").toggleClass(function(){
//     $(".appointment").toggleClass("activeAppointment");
//     // $(this).toggleClass("activeAppointment");
//     // $(this).find(".edit").fadeIn();
//     // $(this).find("delete").show();
  
// });
        </script>
    </body>
</html>