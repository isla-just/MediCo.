<?php

session_start();
$errors2 = array();

$patient_id = htmlspecialchars($_GET["id"]);
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

$user_query = "SELECT * FROM Patients WHERE id = $patient_id";
$user_result = mysqli_query($db,$user_query);
$profile_user = mysqli_fetch_assoc($user_result);

$pat_firstname=$profile_user['firstname'];
$pat_surname=$profile_user['surname'];
$pat_dob=$profile_user['dob'];
$pat_gender=$profile_user['gender'];
$pat_number=$profile_user['number'];
$pat_email=$profile_user['email'];
$pat_profile=$profile_user['profile'];
$pat_medicalAid=$profile_user['medicalAid'];
$pat_ID=$profile_user['patientID'];

if(isset($_POST['update_patient'])){

    //getting values from input fields
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $patientID = mysqli_real_escape_string($db, $_POST['patientID']);
    $medicalAid = mysqli_real_escape_string($db, $_POST['medicalAid']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);

    $profileImage = $_FILES['profileImage']['name'];

    //if the profile image is empty - do this for all thing that remain empty that you put in the db
    if(empty($profileImage)){ 
        $profileImage = $pat_profile;
    } else {
        $profileImage = time() . '_' . $_FILES['profileImage']['name'];
        $imageTarget = '../profiles/' . $profileImage;
        move_uploaded_file($_FILES['profileImage']['tmp_name'], $imageTarget);
    }

    // //check if any of the info is the same
    // $user_check_query = "SELECT * FROM Patients WHERE id != '$patient_id' AND email = '$email' LIMIT 1";
    $user_check_query = "SELECT * FROM Patients WHERE id != '$patient_id' AND email = '$email' OR id != '$patient_id' AND medicalAid='$medicalAid' OR id != '$patient_id' AND number='$number' OR id != '$patient_id' AND patientID='$patientID' LIMIT 1";
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
        echo "query run";
        if($user['email'] === $email){array_push($errors2, "Email already taken");}
        if($user['patientID'] === $patientID){array_push($errors2, "Patient id already in use");}
        if($user['number'] === $number){array_push($errors2, "Phone number already in use");}
        if($user['medicalAid'] === $medicalAid){array_push($errors2, "Medical aid already registered");}
    }

    if(count($errors2) === 0 ){

            $query = "UPDATE Patients SET firstname='$firstname',surname='$surname',dob='$pat_dob',gender='$gender',number='$number',email='$email',profile='$profileImage',medicalAid='$medicalAid',patientID='$patientID' WHERE id = '$patient_id'";
            mysqli_query($db, $query);
            header("location: ../pages/newPatient_updated.php?id=" . $patient_id); 

    }
}//end of button call
?>