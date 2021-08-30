<?php

    //startinf the session
    session_start();

    //db connection
    $db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

    $show_query = "SELECT * FROM Receptionist WHERE rank='banned'";
    $show_result= mysqli_query($db, $show_query);

    if(isset($_SESSION['email'])){

        $email = $_SESSION['email'];
        $check_query="SELECT * FROM Receptionist WHERE email='$email' LIMIT 1";
        $result=mysqli_query($db, $check_query);
        //target the user profile key value pair
        $user = mysqli_fetch_assoc($result);

        $rank=$user['rank'];

        //echo $userProfile;

    }

    if($show_result-> num_rows > 0 ){
        //looping through and appending each result
        while($row = $show_result-> fetch_assoc()){

            if($rank=="head receptionist"){

            echo " <div class='appointment-row' style='width:100%'>
            <a href='../pages/profile.php?id=". $row['id'] . "'><div class='appointment2' value=". $row['id'] . ">
            <div class='profile-pic'><img src='../profiles/". $row['profile'] . "'style='height:40px; width:40px; border-radius:6px;'></img></div>
            <div class='labels1'>" . $row['firstname'] ." ". $row['surname'] . "</div>
            <div class='labels2'>" . $row['email'] . "</div>
            <div class='labels3'>" . $row['number'] . "</div>
            <div class='labels5'>". $row['rank'] . "</div>

            </div></a>
            <a href='../server/ban_receptionist.php?id=". $row['id'] . "'><div class='banbtn'>unban</div></a>
            </div>";
            ;
        }else{
            echo " <div class='appointment-row' style='width:100%'>
            <a href='../pages/profile.php?id=". $row['id'] . "'><div class='appointment2' style='width:100%' value=". $row['id'] . ">
            <div class='profile-pic'><img src='../profiles/". $row['profile'] . "'style='height:40px; width:40px; border-radius:6px;'></img></div>
            <div class='labels1'>" . $row['firstname'] ." ". $row['surname'] . "</div>
            <div class='labels2'>" . $row['email'] . "</div>
            <div class='labels3'>" . $row['number'] . "</div>
            <div class='labels5'>". $row['rank'] . "</div>

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

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
    </head>
    <body>

    </body>
</html>
