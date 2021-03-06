<?php include '../server/sign_user.php'; ?>

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
    <link rel="stylesheet" href="../css/login.css">

    <!--link font selection - choose font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;0,900;1,700&display=swap" rel="stylesheet">
    
    </head>

    <body>
        <div class='half1'>
             <div class="logo"><img src="../assets/logo1.svg" width="90px"></div>
        <h1 class="mainText">WELCOME BACK!</h1>

        <div class="error-block">
        <?php include '../server/error.php'; ?>
        </div><!--error-->
        
        <form action="login.php" enctype="multipart/form-data" method="post">
            <h4 class="input-labels">Email</h4>
            <input class="login-input" type="email" name="email" required>

            <h4 class="input-labels">Password</h4>
            <h4 class="forgot">Forgot your password?</h4>
            <input class="login-input" type="password" name="pass_1" required>
            <!-- if valid then submit-->
            <button class="btn btnStyling" type="submit" name="sign_user">Sign in</button>
        </form>

        <p class='new'>Are you new here? <strong style="text-decoration: underline; cursor: pointer;"><a href="./register.php" style="color: #42497C; text-decoration: none;">Let's create your account</a></strong></p>
        </div><!--half1-->

        <div class='half2'>
            <a href="./register.php"><div class="inactive-btn btnStyling">Register</div></a>
            <div class="btn-active">Sign in</div>

            <div class='illustration'><img src="../assets/receptionist.png" width="600px"></div>
        </div><!--half2-->
       
    </body>
</html>