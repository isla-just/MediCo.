<?php

   $appointment_id = htmlspecialchars($_GET["id"]);

   $db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

   //getting the appointment and doctor
   $select_query = "SELECT * FROM Appointments WHERE id = $appointment_id";
   $select=mysqli_query($db, $select_query);
   $select_info = mysqli_fetch_assoc($select);
   $doctor=$select_info['doctor'];

   $prefix = 'Dr.';
   $surname = $doctor;
   $surname = preg_replace('/^' . preg_quote($prefix, '/') . '/', '', $surname);
   echo $surname;

   $available_query="SELECT * FROM Doctors WHERE surname='$surname'";
   $available_result = mysqli_query($db, $available_query);
   $available= mysqli_fetch_assoc($available_result);

   //getting doctor details to do update query
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

   echo $IDDB;

   $delete_query = "DELETE FROM Appointments WHERE id = $appointment_id";
   mysqli_query($db,$delete_query);

   if($availability!=0){
        //updating the availability of a doctor when it is deleted
        $newAvail=$availability-1;
   $update_doc="UPDATE Doctors SET id='$IDDB', firstname='$firstnameDB',surname='$surnameDB',dob='$dobDB',gender='$genderDB',number='$numberDB',email='$emailDB',profile='$profileDB',specialisation='$specialisationDB',room='$roomDB',availability='$newAvail',doctorID='$doctorIDDB' WHERE surname='$surname'";
   $update_result=mysqli_query($db, $update_doc);
   }

   //sending a default id
      $check_id="SELECT id FROM Appointments ORDER BY id ASC LIMIT 1;";
   $check_result=mysqli_query($db, $check_id);
   $user1 = mysqli_fetch_assoc($check_result);
   $send_id=$user1['id'];

      //making the doctor available
   //room is already taken validation 

   header("location: ../pages/landing.php?id=". $send_id. ""); 

   //update availability again
?>