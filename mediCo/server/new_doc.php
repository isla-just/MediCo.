<?php
    //startinf the session
    session_start();

    $errors = array();

    //db connection
    $db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

    if(isset($_POST['add_doc'])){
        $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
        $surname = mysqli_real_escape_string($db, $_POST['surname']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $number = mysqli_real_escape_string($db, $_POST['number']);
        $doctorID = mysqli_real_escape_string($db, $_POST['doctorID']);
        $gender = mysqli_real_escape_string($db, $_POST['gender']);
        $specialisation = mysqli_real_escape_string($db, $_POST['specialisation']);
        $room = mysqli_real_escape_string($db, $_POST['room']);
        $dob = mysqli_real_escape_string($db, $_POST['dob']);

        $profile = time() . '_' . $_FILES['profile']['name'];
        $imageTarget = '../profiles/' . $profile;
        move_uploaded_file($_FILES['profile']['tmp_name'], $imageTarget);

        // $user_check_query = "SELECT * FROM Doctors WHERE number = '$number' LIMIT 1";
        $user_check_query = "SELECT * FROM Doctors WHERE number = '$number' OR email = '$email' OR room = '$room' OR doctorID='$doctorID' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
    
        if($user){
            if($user['number'] === $number){array_push($errors, "Phone number already taken");}
            if($user['email'] === $email){array_push($errors, "Email already in use");}
            if($user['room'] === $room){array_push($errors, "Room is aready taken");}
            if($user['doctorID'] === $doctorID){array_push($errors, "This ID has alreadt been registered");}
        }


    if(count($errors) == 0 ){
        $query = "INSERT INTO Doctors(firstname, surname, dob, gender, number, email, profile, specialisation, room, availability, doctorID) VALUES ('$firstname','$surname','$dob','$gender','$number','$email','$profile','$specialisation','$room',0,'$doctorID')";
        $result = mysqli_query($db, $query);
        if($result){

            $check_id="SELECT id FROM Doctors ORDER BY id DESC LIMIT 1;";
            $check_result=mysqli_query($db, $check_id);
            $user1 = mysqli_fetch_assoc($check_result);
            $send_id=$user1['id'];
            
            // $_SESSION['username'] = $username;
            $_SESSION['msg'] = 'Profile successfully created, login to continue';
            header("location: ../pages/newDoc_added.php?id=" . $send_id .""); 
        } else {
            array_push($errors, "There seems to be a problem on our side, please contact admin for assistance");
        }
    }
    }//end of button call
?>