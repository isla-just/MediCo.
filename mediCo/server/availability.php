<?php

    //startinf the session
    session_start();

    $doctor_id = htmlspecialchars($_GET["id"]);
// echo $doctor_id;
    //db connection
    $db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

    $available_query="SELECT * FROM Doctors WHERE id='$doctor_id'";
    $available_result = mysqli_query($db, $available_query);
    $available= mysqli_fetch_assoc($available_result);

$scale=$available['available'];
echo $scale;
// echo $scale;
?>