<?php

   $doctor_id = htmlspecialchars($_GET["id"]);

   $db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

   $delete_query = "DELETE FROM Doctors WHERE id = $doctor_id";
   mysqli_query($db,$delete_query);

      $check_id="SELECT id FROM Doctors ORDER BY id ASC LIMIT 1;";
   $check_result=mysqli_query($db, $check_id);
   $user1 = mysqli_fetch_assoc($check_result);
   $send_id=$user1['id'];

   header("location: ../pages/newDoc.php?id=". $send_id. ""); 

   //update availability again
?>