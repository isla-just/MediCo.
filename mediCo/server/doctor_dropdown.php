<?php

    //startinf the session
    session_start();

     //db connection
     $db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

     $show_query = "SELECT surname FROM Doctors";
     $show_result= mysqli_query($db, $show_query);
 
     if($show_result-> num_rows > 0 ){
         //looping through and appending each result
         while($row = $show_result-> fetch_assoc()){
 
             echo "<option value= Dr." . $row['surname'] . ">" . "Dr. " . $row['surname'] . "</option>";
             
         }
     }

    //db connection

?>