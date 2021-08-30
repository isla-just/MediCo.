<?php

   session_start();

   $user_id = htmlspecialchars($_GET["id"]);
   $db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

   $user_query = "SELECT * FROM Receptionist WHERE id = $user_id";
   $user_result = mysqli_query($db,$user_query);
   $profile_user = mysqli_fetch_assoc($user_result);

   $access = $profile_user['rank'];

     if($access === 'banned'){
    $ban_query = "UPDATE Receptionist SET rank = 'regular receptionist' WHERE id = '$user_id'";
    mysqli_query($db, $ban_query);
   }

   header("location: ../pages/banned_popup.php?id=". $user_id . ""); 


?>