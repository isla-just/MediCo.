<?php

session_start();
$errors2 = array();

$appointment_id = htmlspecialchars($_GET["id"]);
$db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

if(!isset($_SESSION['email'])){
    header('location: login.php');
}

// chack authoristaion of user

// if(isset($_SESSION['email'])){
//     $auth=$_SESSION['rank'];

//     $check_query = "SELECT * FROM Receptionists WHERE rank = '$user_id'";
//     $result = mysqli_query($db,$check_query);
//     $user = mysqli_fetch_assoc($result);

//     //set the variables you might need
// }

$user_query = "SELECT * FROM Appointments WHERE id = $appointment_id";
$user_result = mysqli_query($db,$user_query);
$profile_user = mysqli_fetch_assoc($user_result);

$app_doc=$profile_user['doctor'];
$app_pat=$profile_user['patient'];
$app_date=$profile_user['date'];
$app_time=$profile_user['time'];
$app_room=$profile_user['room'];

if(isset($_POST['update_appointment'])){

    //getting values from input fields
    $doctor=mysqli_real_escape_string($db, $_POST['doctor']);
    $patient=mysqli_real_escape_string($db, $_POST['patient']);
    $date=mysqli_real_escape_string($db, $_POST['date']);
    $time=mysqli_real_escape_string($db, $_POST['time']);
    $room=mysqli_real_escape_string($db, $_POST['room']);

echo $doctor;
//checking doctor availabiity
$prefix = 'Dr.';
$surname = $doctor;
$surname = preg_replace('/^' . preg_quote($prefix, '/') . '/', '', $surname);

$available_query="SELECT * FROM Doctors WHERE surname='$surname'";
$available_result = mysqli_query($db, $available_query);
$available= mysqli_fetch_assoc($available_result);

//getting doctor details
$availability=$available['availability'];

if($availability>=10){
    array_push($errors2, "The doctor of choice is fully booked");
 }

    if(count($errors2) === 0 ){
            $query="UPDATE Appointments SET doctor='$doctor',patient='$patient',date='$date',time='$time',room='$room' WHERE id='$appointment_id'";
            mysqli_query($db, $query);

            header("location: ../pages/landing.php"); 

    }
}//end of button call
?>