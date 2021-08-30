<?php

session_start();
$errors2 = array();

$doctor_id = htmlspecialchars($_GET["id"]);
$db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

if(!isset($_SESSION['email'])){
    header('location: login.php');
}

// chack authoristaion of user

// if(isset($_SESSION['email'])){
//     $auth=$_SESSION['rank'];

//     $check_query = "SELECT * FROM Receptionists WHERE rank = '$user_id'";
//     $result = mysqli_query($db,$check_query);
//     $user = mysqli_fetch_assoc($result);

//     //set the variables you might need
// }

$user_query = "SELECT * FROM Doctors WHERE id = $doctor_id";
$user_result = mysqli_query($db,$user_query);
$profile_user = mysqli_fetch_assoc($user_result);

$doc_firstname=$profile_user['firstname'];
$doc_surname=$profile_user['surname'];
$doc_dob=$profile_user['dob'];
$doc_gender=$profile_user['gender'];
$doc_number=$profile_user['number'];
$doc_email=$profile_user['email'];
$doc_profile=$profile_user['profile'];
$doc_specialisation=$profile_user['specialisation'];
$doc_room=$profile_user['room'];
$doc_availability=$profile_user['availability'];
$doc_ID=$profile_user['doctorID'];

if(isset($_POST['update_doctor'])){

    //getting values from input fields
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $doctorID = mysqli_real_escape_string($db, $_POST['doctorID']);
    $specialisation = mysqli_real_escape_string($db, $_POST['specialisation']);
    $room= mysqli_real_escape_string($db, $_POST['room']);

    $profileImage = $_FILES['profileImage']['name'];

    //if the profile image is empty - do this for all thing that remain empty that you put in the db
    if(empty($profileImage)){ 
        $profileImage = $doc_profile;
    } else {
        $profileImage = time() . '_' . $_FILES['profileImage']['name'];
        $imageTarget = '../profiles/' . $profileImage;
        move_uploaded_file($_FILES['profileImage']['tmp_name'], $imageTarget);
    }

    // //check if any of the info is the same
    $user_check_query = "SELECT * FROM Doctors WHERE id != '$doctor_id' AND email = '$email' OR id != '$doctor_id' AND doctorID='$doc_ID' OR id != '$doctor_id' AND room='$room' OR id != '$doctor_id' AND number='$number' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    //     $user_check_query = "SELECT * FROM Receptionist WHERE number = '$number' OR email = '$email1' AND id NOT '$user_id' LIMIT 1";
//     $result = mysqli_query($db, $user_check_query);
//     $user = mysqli_fetch_assoc($result);

//     if($user){
//         if($user['number'] === $number){array_push($errors, "phone number already taken");}
//         if($user['email'] === $email){array_push($errors, "email already taken");}
//     }
    if($user){
        if($user['email'] === $email){array_push($errors2, "Email already taken");}
        if($user['doctorID'] === $doctorID){array_push($errors2, "Doctor id already in use");}
        if($user['room'] === $room){array_push($errors2, "Another doctor is using this room");}
        if($user['number'] === $number){array_push($errors2, "Phone number already in use");}
    }


    if(count($errors2) === 0 ){

            $query = "UPDATE Doctors SET firstname='$firstname',surname='$surname',dob='$doc_dob',gender='$doc_gender',number='$number',email='$email',profile='$profileImage',specialisation='$specialisation',room='$room',availability='$doc_availability',doctorID='$doctorID' WHERE id = '$doctor_id'";
            mysqli_query($db, $query);
            header("location: ../pages/newDoc_edited.php?id=" . $doctor_id); 

    }
}//end of button call
?>