<?php

    //startinf the session
    session_start();

    //db connection
    $db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

    if(isset($_POST['submit_search'])){
        $searchTerm = mysqli_real_escape_string($db, $_POST['search']) . '%';


    $show_query = "SELECT * FROM Receptionist WHERE firstname LIKE '$searchTerm'";
    $show_result= mysqli_query($db, $show_query);

    if($show_result-> num_rows > 0 ){
        //looping through and appending each result
        while($row = $show_result-> fetch_assoc()){

            echo " <a href='../pages/profile.php?id=". $row['id'] . "'><div class='appointment' value=". $row['id'] . ">
            <div class='profile-pic'><img src='../profiles/". $row['profile'] . "'style='height:40px; width:40px; border-radius:6px;'></img></div>
            <div class='labels1'>" . $row['firstname'] ." ". $row['surname'] . "</div>
            <div class='labels2'>" . $row['email'] . "</div>
            <div class='labels3'>" . $row['number'] . "</div>
            <div class='labels5'>". $row['rank'] . "</div>

            </div></a>";
            // echo "<div class='appointment'>
            //     <div class='profile-pic'></div>
            //     <div class='labels1'>" . $row['patient'] . "</div>
            //     <div class='labels2'>" . $row['doctor'] . "</div>
            //     <div class='labels3'>" . $row['date'] . "</div>
            //     <div class='labels4'>" . $row['time'] . "</div>
            //     <div class='labels5'>" . $row['room'] . "</div>
            // </div>";
        }
    }
}else if(!isset($_POST['submit_search'])){
    $show_query = "SELECT * FROM Receptionist";
    $show_result= mysqli_query($db, $show_query);

    if($show_result-> num_rows > 0 ){
        //looping through and appending each result
        while($row = $show_result-> fetch_assoc()){

            echo " <a href='../pages/profile.php?id=". $row['id'] . "'><div class='appointment' value=". $row['id'] . ">
            <div class='profile-pic'><img src='../profiles/". $row['profile'] . "'style='height:40px; width:40px; border-radius:6px;'></img></div>
            <div class='labels1'>" . $row['firstname'] ." ". $row['surname'] . "</div>
            <div class='labels2'>" . $row['email'] . "</div>
            <div class='labels3'>" . $row['number'] . "</div>
            <div class='labels5'>". $row['rank'] . "</div>

            </div></a>";
            // echo "<div class='appointment'>
            //     <div class='profile-pic'></div>
            //     <div class='labels1'>" . $row['patient'] . "</div>
            //     <div class='labels2'>" . $row['doctor'] . "</div>
            //     <div class='labels3'>" . $row['date'] . "</div>
            //     <div class='labels4'>" . $row['time'] . "</div>
            //     <div class='labels5'>" . $row['room'] . "</div>
            // </div>";
        }
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
    </head>
    <body>

    </body>
</html>
