<?php
    //startinf the session
    session_start();

    $errors = array();

    //db connection
    $db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

    if(isset($_POST['add_patient'])){
        $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
        $surname = mysqli_real_escape_string($db, $_POST['surname']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $number = mysqli_real_escape_string($db, $_POST['number']);
        $patientID = mysqli_real_escape_string($db, $_POST['patientID']);
        $gender = mysqli_real_escape_string($db, $_POST['gender']);
        $medicalAid = mysqli_real_escape_string($db, $_POST['medicalAid']);
        $dob = mysqli_real_escape_string($db, $_POST['dob']);

        $profile = time() . '_' . $_FILES['profile']['name'];
        $imageTarget = '../profiles/' . $profile;
        move_uploaded_file($_FILES['profile']['tmp_name'], $imageTarget);

        // $user_check_query = "SELECT * FROM Doctors WHERE number = '$number' LIMIT 1";
        $user_check_query = "SELECT * FROM Patients WHERE number = '$number' OR email = '$email' OR medicalAid = '$medicalAid' OR patientID='$patientID' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
    
        if($user){
            if($user['number'] === $number){array_push($errors, "Phone number already taken");}
            if($user['email'] === $email){array_push($errors, "Email already in use");}
            if($user['medicalAid'] === $medicalAid){array_push($errors, "Medical aid number is already registered with us");}
            if($user['patientID'] === $patientID){array_push($errors, "This ID has already been registered");}
        }


    if(count($errors) == 0 ){
        $query = "INSERT INTO Patients(firstname, surname, dob, gender, number, email, profile, medicalAid, patientID) VALUES ('$firstname','$surname','$dob','$gender','$number','$email','$profile','$medicalAid','$patientID')";
        $result = mysqli_query($db, $query);
        
        if($result){

            $check_id="SELECT id FROM Patients ORDER BY id DESC LIMIT 1;";
            $check_result=mysqli_query($db, $check_id);
            $user1 = mysqli_fetch_assoc($check_result);
            $send_id=$user1['id'];
            
            // $_SESSION['username'] = $username;
            $_SESSION['msg'] = 'Profile successfully created, login to continue';
            header("location: ../pages/newPatient_added.php?id=" . $send_id .""); 
            // header("location: ../pages/login.php"); 
        } else {
            array_push($errors, "There seems to be a problem on our side, please contact admin for assistance");
        }
    }
    }//end of button call
?>