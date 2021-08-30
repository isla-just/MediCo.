
<?php
session_start();
$errors=array();

// //targeting the id we are lookinh at - cant send all the data across sessions (we will rerun thre query)
$rec_id = htmlspecialchars($_GET["id"]);
$db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");


if(!isset($_SESSION['email'])){
    //include every page for security
    $_SESSION['msg']="You need to login";
    header('location:login.php');
}

if(isset($_SESSION['email'])){
    //to get admin details
    $email=$_SESSION['email'];

    $check_query="SELECT * FROM Receptionist WHERE email='$email'LIMIT 1";
    $result=mysqli_query($db, $check_query);

    $user= mysqli_fetch_assoc($result);
    $adminPassword=$user['password'];
}  

// //shoudl only return one
$user_query = "SELECT * FROM Receptionist WHERE id = $rec_id";
$user_result = mysqli_query($db,$user_query);
$profile_user = mysqli_fetch_assoc($user_result);

$rec_firstname=$profile_user['firstname'];
$rec_surname=$profile_user['surname'];
$rec_dob=$profile_user['dob'];
$rec_gender=$profile_user['gender'];
$rec_number=$profile_user['number'];
$rec_email=$profile_user['email'];
$rec_pword=$profile_user['password'];
$rec_rank=$profile_user['rank'];
$rec_profile=$profile_user['profile'];


// // //update function for curreny user information
if(isset($_POST['update_receptionist'])){

    //getting values from input fields
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $email1 = mysqli_real_escape_string($db, $_POST['email']);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $rank = mysqli_real_escape_string($db, $_POST['rank']);
    $confirmPassword= mysqli_real_escape_string($db, $_POST['password']);

    $profileImage = $_FILES['profileImage']['name'];

    //if the profile image is empty - do this for all thing that remain empty that you put in the db
    if(empty($profileImage)){ 
        $profileImage = $rec_profile;
    } else {
        $profileImage = time() . '_' . $_FILES['profileImage']['name'];
        $imageTarget = '../profiles/' . $profileImage;
        move_uploaded_file($_FILES['profileImage']['tmp_name'], $imageTarget);
    }

//check if any of the info is the same
        $user_check_query = "SELECT * FROM Receptionist WHERE id != '$rec_id' AND email = '$email1' OR  id != '$rec_id' AND number='$number' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);


$password=hash('sha256', $pass1);
    if(hash('sha256',$confirmPassword) != $adminPassword){array_push($errors, "Your password is incorrect");} 

    if($user){
        echo "found an error";
        if($user['number'] === $number){array_push($errors, "phone number already taken");}
        if($user['email'] === $email1){array_push($errors, "email already taken");}
    }


    if(count($errors) === 0 ){
        $query="UPDATE Receptionist SET firstname='$firstname',surname='$surname',dob='$rec_dob',gender='$rec_gender',number='$number',email='$email1',password='$rec_pword',rank='$rank',profile='$profileImage' WHERE id='$rec_id'";
        mysqli_query($db, $query);
        echo "tried to query";
        header("location: ../pages/profile_updated.php?id=" . $rec_id. ""); 

}

//     if(count($errors)==0){
//         echo "tried to query";
//         // $encryptedPword=md5($pass3);
//         $query="UPDATE Receptionist SET firstname='$firstname',surname='$surname',dob='',gender='$gender',number='$number',email='$email',password='$pass3',rank='$rank',profile='' WHERE id='$user_id'";
//         $result= mysqli_query($db, $query);

//         echo "Profile has been successfully updated";
//         // header("location: ../pages/profile.php?id=" . $user_id);
//     }
}//end of isset

?>