<?php
//startinf the session
session_start();

//array to populate with errors
$errors=array();

//db connection
$db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

// echo "everything is connected";
if(isset($_POST['add_user'])){

    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $dob = mysqli_real_escape_string($db, $_POST['dob']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass1 = mysqli_real_escape_string($db, $_POST['pass_1']);
    $pass2 = mysqli_real_escape_string($db, $_POST['pass_2']);
    $rank = mysqli_real_escape_string($db, $_POST['rank']);

    $profileImage = time() . '_' . $_FILES['profileImage']['name'];
    $imageTarget = '../profiles/' . $profileImage;
    move_uploaded_file($_FILES['profileImage']['tmp_name'], $imageTarget);

    if(empty($firstname)){array_push($errors, "your name is required");} 
    if(empty($surname)){array_push($errors, "your surname is required");} 
    if(empty($dob)){array_push($errors, "your date of birth is required");} 
    if(empty($gender)){array_push($errors, "your gender is required");} 
    if(empty($number)){array_push($errors, "your phone number is required");} 
    if(empty($email)){array_push($errors, "your email is required");} 
    if(empty($rank)){array_push($errors, "your rank is required");} 
    if(empty($pass1)){array_push($errors, "A password is Required");} 
    if($pass1 !== $pass2){array_push($errors, "your passwords do not match");}
    
    $user_check_query = "SELECT * FROM Receptionist WHERE number = '$number' OR email = '$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if($user){
        // echo "tried to query";
        if($user['number'] === $number){array_push($errors, "phone number already taken");}
        if($user['email'] === $email){array_push($errors, "email already taken");}
    }

    //if there are no errors, insert into database
    if(count($errors) ==0 ){
        //emcrypt the password
        $password=hash('sha256', $pass1);

        $query="INSERT INTO Receptionist (firstname, surname, dob, gender, number, email, password, rank, profile) VALUES ('$firstname','$surname','$dob','$gender','$number','$email','$password','$rank','$profileImage')";
        mysqli_query($db, $query);
        header("location: ../pages/login_popup.php"); 

        // echo "pushed to database";
    }

}//end of submit acion

?>