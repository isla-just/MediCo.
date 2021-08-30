<?php include '../server/update_receptionist.php' ?>    

<?php 
     $user_id = htmlspecialchars($_GET["id"]);
?>

<?php 
    session_start();

//db connection
$db = mysqli_connect('localhost', 'root', 'root', 'DoctorsRooms') or die("DB connection failed, contact your admin");

    if(!isset($_SESSION['email'])){
        $_SESSION['msg'] = "You need to login, no hackers here mate!";
        header('location: login.php');
    }

    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $check_query2="SELECT * FROM Receptionist WHERE email='$email' LIMIT 1";
        $result2=mysqli_query($db, $check_query2);
        //target the user profile key value pair
        $user2 = mysqli_fetch_assoc($result2);
        $officialRank=$user2['rank'];
        $officialName=$user2['firstname'];
    }

    $check_query="SELECT * FROM Receptionist WHERE id='$user_id' LIMIT 1";
    $result=mysqli_query($db, $check_query);
    //target the user profile key value pair
    $user = mysqli_fetch_assoc($result);

    $userProfile=$user['profile'];
    $firstName=$user['firstname'];
    $surname=$user['surname'];
    $activeRank=$user['rank'];
    $number=$user['number'];
    $email2=$user['email'];
    $rec_id=$user['id'];

    $gender=$user['gender'];

    $check_id="SELECT id FROM Doctors ORDER BY id ASC LIMIT 1;";
    $check_result=mysqli_query($db, $check_id);
    $user1 = mysqli_fetch_assoc($check_result);
    $send_id=$user1['id'];

?>

<!DOCTYPE html>
<html lang="eng-US">
    <head>
    <meta name="subject" content="IDV200">
    <meta name="Lecturer" content="Mike Maynard">
    <meta name="StudentNumber" content="200080">
    <meta name="StudentName" content="Isla Just">
    <meta name="Assessment" content="Term3 project">
    <meta charset="utf-8">

    <title>MediCo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>

    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/profile.css">

    <!--link font selection - choose font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;0,900;1,700&display=swap" rel="stylesheet">
    
    </head>

    <body>
        <div class='container-fluid'>
            <div class='vert-nav'>

                <div class="logo"><img src="../assets/logo2.svg" height="40px"></div>


                <a href="../pages/landing.php"><div class="home"><img src="../assets/Group 8.svg"  width= "27px"></img></div></a>
                <a href="../pages/profile.php"><div class="profile"><img src="../assets/Group 11.svg"  width= "25px"></img></div></a>
                <a href= <?php echo "../pages/newDoc.php?id=" . $send_id . ""?>><div class="profile"><img src="../assets/Group 12.svg"  width= "25px"></img></div></a> 

                <div class="bloop"><img src="../assets/bloop.svg"></img></div>

               <a href="../server/logout.php"> <div class="exit"><img src="../assets/Group 9.svg"  width= "25px"></img></div></a>

            </div>
            <div class="main-card">
                <div class="section1">
                <form method="post" enctype="multipart/form-data">  
                    <input class="search" name="search" placeholder="Looking for a receptionist?" required>
                    
                    <button class="search-container" type="submit" name="submit_search" ><img src="../assets/search.svg" width="18px"></img></button>
           
                    </form>

                    <div class="goodMorningBlock">

                    <h1>Good morning,  <strong><?php echo $officialName ?></strong></h1>

                        <p>Have a great day at work!</p>
                    </div><!--good morning block-->

                    <h5 class="schedule">Other Receptionists</h5>
                    <div class="titles" style='margin-left:5px'>Name</div>
                    <div class="titles" style='margin-left:75px'>Email</div>
                    <div class="titles" style='margin-left:30px'>Telephone</div>
                    <div class="titles">Rank</div>

                    <div class="appointments">
                        
                    <?php include '../server/show_receptionist.php' ?>   
                    <div class="endOfSearch">You've reached the end of your search</div>
                    <form method="post" enctype="multipart/form-data"> 
                    <button class="showAll" type="submit" name="clear_search">Show all results</button>
                    </form>    
 
                                  
                </div><!--appointments-->

                <h5 class="schedule">Banned receptionists</h5>

                <div class="banned">


                <?php include '../server/show_banned_receptionist.php' ?>   
                </div>
               
                </div><!--section1 -->
                <div class="section2">
                    <h5 style="margin-top: 0px; text-align: center; margin-left: 0px; margin-bottom: 20px;">Active profile</h5>

                    <div class="empty-profile-pic">
                        <img src="../profiles/<?php echo $userProfile ?>" style="width:170px; height:170px; border-radius:50%"></img>
                    </div>

                        <h2><?php echo $firstName . ' ' . $surname ?></h2>
                        <p><?php echo $activeRank?></p>

                    
                    <h5>Edit details</h5>

                    <form enctype="multipart/form-data" method="post">

                    <div class="input-labels">First name</div>   <div class="input-labels" style="margin-left: 4%;" required>Surname</div>
                    <input class="newBooking" value="<?php echo $firstName?>" name="firstname" required>
                    <input class="newBooking" value="<?php echo $surname?>" style="margin-left: 4%;"  name="surname" required>

                    <div class="input-labels">Email</div>   <div class="input-labels" style="margin-left: 4%;">Telephone</div>
                    <input class="newBooking" value="<?php echo $email2?>"  name="email" required>
                    <input class="newBooking" value="<?php echo $number?>" style="margin-left: 4%;"  name="number" required>


                    <div class="input-labels">Rank</div>   <div class="input-labels" style="margin-left: 4%;">Profile Picture</div>
                    <input class="newBooking" value="<?php echo $activeRank?>"  name="rank" required style="float:left;">
                    <input class="newBooking" type="file" style="margin-left: 4%; margin-bottom:10px; float:left;" name="profileImage">

   
                    <div class="input-labels">Admin Password</div>  
                    <input class="newBooking" type="password" name="password" required style="width:85%"  name="password" required>

                    <div class="errorBlock">
                    <?php include "../server/error.php"?>
                    </div>

                    <?php if($officialRank=="head receptionist") : ?>
                    <button class="checkBtn" type="submit" name="update_receptionist" style="margin-top:20px" >Update <?php echo $firstName?>'s info</button>
                <?php endif?>
                    </form>

                        <a href="../server/logout.php"><p style="text-decoration: underline; margin-top: 50px;">Log out of my account</p></a>
                </div><!--section2-->
            </div><!--main card-->
        </div>

        <div class="popup">
            <div class="sure">
                <a href="../pages/profile.php?id=<?php echo $rec_id?> "><div class="cancel"><img src="../assets/close.png" style="width:20px; float:right"></img></div></a>

            <h3 style="margin-top:40px"><?php echo $firstName?>'s information has been updated</h3>
            <p style="margin-top:15px"><?php echo $email2?></p>
            <div class="illustration2"></div>
            </div>
        </div>


    </body>
</html>