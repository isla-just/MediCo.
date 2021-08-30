<?php

    //startinf the session
    session_start();

    $errors = array();

    //db connection
    $db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

    if(isset($_POST['add_appointment'])){
        $patient=mysqli_real_escape_string($db, $_POST['patient']);
        $doctor=mysqli_real_escape_string($db, $_POST['doctor']);
        $date=mysqli_real_escape_string($db, $_POST['date']);
        $time=mysqli_real_escape_string($db, $_POST['time']);
        $room=mysqli_real_escape_string($db, $_POST['room']);

//room is already taken validation 
$prefix = 'Dr.';
$surname = $doctor;
$surname = preg_replace('/^' . preg_quote($prefix, '/') . '/', '', $surname);

$available_query="SELECT * FROM Doctors WHERE surname='$surname'";
$available_result = mysqli_query($db, $available_query);
$available= mysqli_fetch_assoc($available_result);

//getting doctor details
$availability=$available['availability'];
$firstnameDB=$available['firstname'];
$surnameDB=$available['surname'];
$dobDB=$available['dob'];
$genderDB=$available['gender'];
$numberDB=$available['number'];
$emailDB=$available['email'];
$profileDB=$available['profile'];
$specialisationDB=$available['specialisation'];
$roomDB=$available['room'];
$doctorIDDB=$available['doctorID'];
$IDDB=$available['id'];

//update doctor availability and increment by 1. If availability is at 10 ten display popup full

if($availability>=10){
   array_push($errors, "The doctor of choice is fully booked");
}


if(count($errors) == 0 ){
    $query = "INSERT INTO Appointments (doctor, patient, date, time, room) VALUES ('$doctor', '$patient', '$date', '$time', '$room')";
    $result = mysqli_query($db, $query);
    
    $update_doc="UPDATE Doctors SET id='$IDDB', firstname='$firstnameDB',surname='$surnameDB',dob='$dobDB',gender='$genderDB',number='$numberDB',email='$emailDB',profile='$profileDB',specialisation='$specialisationDB',room='$roomDB',availability='$availability'+1,doctorID='$doctorIDDB' WHERE surname='$surname'";
    $update_result = mysqli_query($db, $update_doc);
    $test= mysqli_fetch_assoc($update_result);

    $check_id="SELECT id FROM Appointments ORDER BY id ASC LIMIT 1;";
    $check_result=mysqli_query($db, $check_id);
    $user1 = mysqli_fetch_assoc($check_result);
    $send_id=$user1['id'];
 
    header("location: ../pages/landing_created.php"); 
}

    }//end of add appointment button call
?>