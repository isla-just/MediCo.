<?php
//startinf the session
session_start();
    

$errors = array();

$db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");


$check_id="SELECT id FROM Appointments ORDER BY id ASC LIMIT 1;";
$check_result=mysqli_query($db, $check_id);
$user1 = mysqli_fetch_assoc($check_result);
$send_id=$user1['id'];

if(isset($_POST['sign_user'])){
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass1 = mysqli_real_escape_string($db, $_POST['pass_1']);

    // if(empty($email)){array_push($errors, "Your email is Required");} 
    // if(empty($pass1)){array_push($errors, "A Password is Required");} 

    if(count($errors) == 0 ){
        //encryption]
        $password=hash('sha256', $pass1);
        $query = "SELECT * FROM Receptionist WHERE email='$email' AND password='$password'";
        $result = mysqli_query($db, $query);

        $check = mysqli_fetch_assoc($result);

        $banned=$check['rank'];

        if($banned==='banned'){
            header("location: ../pages/login_banned.php"); 
        }else if(mysqli_num_rows($result)){

            //returns the number of rows in a result set.
            $_SESSION['email'] = $email;
            header("location: ../pages/landing.php?id=" . $send_id . ""); 
            // echo "well done!";
        }else{
            array_push($errors, "Your username or password is incorrect");
        }

    }


}// end of reg button call



?>