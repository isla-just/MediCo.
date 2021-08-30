<?php

    //startinf the session
    session_start();

    //db connection
    $db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

    if(!isset($_SESSION['email'])){

        //include every page for security
        $_SESSION['msg']="You need to login";
        header('location:login.php');
    }

    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $check_query="SELECT * FROM Receptionist WHERE email='$email' LIMIT 1";
        $result=mysqli_query($db, $check_query);
        //target the user profile key value pair
        $user = mysqli_fetch_assoc($result);

        $rank=$user['rank'];

        //echo $userProfile;

    }

    $show_query = "SELECT * FROM Doctors";
    $show_result= mysqli_query($db, $show_query);

    if($show_result-> num_rows > 0 ){
        //looping through and appending each result
        while($row = $show_result-> fetch_assoc()){

            if($rank==="head receptionist"){

            echo "<div class='appointment-row' style='width:100%'>
            <a href='../pages/newDoc.php?id=". $row['id'] . "'><div class='appointment' value='". $row['id'] . "'>
            <div class='profile-pic'><img src='../profiles/". $row['profile'] . "'style='height:40px; width:40px; border-radius:6px;'></img></div>
            <div class='labels1'>" . $row['firstname'] ." " . $row['surname'] . "</div>
            <div class='labels2' style='margin-left:30px'>" . $row['specialisation'] . "</div>
            <div class='labels3' style='margin-left:35px'>" . $row['number'] . "</div>
            <div class='labels4' style='margin-left:25px'>" . $row['gender'] . "</div>
            <div class='labels5' style='margin-left:45px'>" . $row['room'] . "</div>
          
        </div></a>
        <a href='../pages/newDoc_delete.php?id=". $row['id'] . "'><div class='delete'><img src='../assets/delete.svg' style='width:22px; float:left;'></img></div></a>
        </div>";
            }else{

            echo "<div class='appointment-row' style='width:100%'>
            <a href='../pages/newDoc.php?id=". $row['id'] . "'><div class='appointment' style='width:100%' value='". $row['id'] . "'>
            <div class='profile-pic'><img src='../profiles/". $row['profile'] . "'style='height:40px; width:40px; border-radius:6px;'></img></div>
            <div class='labels1'>" . $row['firstname'] ." " . $row['surname'] . "</div>
            <div class='labels2'>" . $row['specialisation'] . "</div>
            <div class='labels3'>" . $row['number'] . "</div>
            <div class='labels4'>" . $row['gender'] . "</div>
            <div class='labels5'>" . $row['room'] . "</div>
          
        </div></a>
        </div>";
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
    </head>
    <body>

    </body>
</html>