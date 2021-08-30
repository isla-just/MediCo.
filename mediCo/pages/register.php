<!--add includes server-->
<?php include '../server/reg_user.php';?>

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
    <link rel="stylesheet" href="../css/register.css">

    <!--link font selection - choose font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;0,900;1,700&display=swap" rel="stylesheet">
    
    <script>
        function previewFile(input){
            var file = $("input[type=file]").get(0).files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#preview_image").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

    </head>

    <body>
        <div class="container-fluid">
        <div class='half1'>
             <div class="logo"><img src="../assets/logo1.svg" width="90px"></div>
        <h1 class="mainText">REGISTRATION</h1>
        <div class="wizard-row">
            <div class="line"></div>
            <div class='circle circle1'>1</div>
            <div class="description describe1">Details</div>

            <div class="line" style="margin-left:20px; opacity: 0.7;"></div>
            <div class='circle circle2' style="opacity: 0.7;">2</div>
            <div class="description describe2" style="opacity: 0.7;">Account</div>

            <div class="line" style="margin-left:20px; opacity: 0.7;"></div>
            <div class='circle circle3' style="opacity: 0.7;">3</div>
            <div class="description describe3" style="opacity: 0.7;">Personal</div>

        </div><!--wizard row-->

        <div class="error-block">
        <?php include '../server/error.php'; ?>

        </div><!--error-->

        <div class="form-container">
        <form enctype="multipart/form-data" action="register.php" method="post">
        <div class="firstStep">

        <div class="row">
                <div class="half">
                    <h4 class="input-labels">First name</h4>
                <input class="login-input-half fname" type="text" name="firstname" required>
                </div><!--half-->

                <div class="half">
                    <h4 class="input-labels" style="margin-left: 5%;">Surname</h4>
                    <input class="login-input-half sname"  style="margin-left: 5%;"  type="text" name="surname" required>
            </div>
            
            </div><!--row-->

            <div class="row">
                <div class="half">
                    <h4 class="input-labels">Birthdate</h4>
                <input class="login-input-half" type="date" name="dob" required>
                </div><!--half-->

                <div class="half">
                    <h4 class="input-labels" style="margin-left: 5%;">Gender</h4>
            <select class="gender-input-half" style="margin-left: 5%;" name="gender" required>  
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
            </div>
            
            </div><!--row-->

            <h4 class="input-labels">Phone number</h4>
            <input class="login-input" placeholder="+27 00 000 0000"  type="tel" pattern=".{10,}" title="A phone number is at least 10 characters" name="number" required>
            <p class="nextText">Moving on</p>
            
            <div class="circle nextStep" style="margin-left: 90%; margin-top: -36px; padding: 10px;"><img src="../assets/Path 21.svg"></img></div>

        </div><!--first step-->

        <div class="secondStep">

    <h4 class="input-labels">Email</h4>
    <input class="login-input email" type="email" name="email" required>

    <div class="row">
        <div class="half">
            <h4 class="input-labels" style="margin-left: 0;" >Password</h4>
        <input class="login-input-half" type="password" name="pass_1" required>
        </div>

        <div class="half">
            <h4 class="input-labels" style="margin-left: 0;"  style="margin-left: 5%;">Confirm</h4>
            <input class="login-input-half" type="password" name="pass_2"  style="margin-left: 5%;" required>
    </div>
    
    </div>

    <h4 class="input-labels">Receptionist rank</h4>
    <select class="rank-input" name="rank">
        <option value="head receptionist">Head Receptionist</option>
        <option value='regular receptionist'>Regular Receptionist</option>
        <option value="trainee">Trainee</option>

    </select>
    <p class="nextText">Moving on</p>
    
    <div class="circle nextUp2" style="margin-left: 90%; margin-top: -36px; padding: 10px;"><img src="../assets/Path 21.svg"></img></div>
        </div><!--secondz-->

        <div class="thirdStep">
            <h4 class="input-labels">Select a profile picture to upload</h4>
            <div class="container">
                <div>
                <div class="preview">
                <img id="preview_image"  style=" height:73px; width: 73px; border-radius: 8px;">
                </div>
                <input  id="custom-file-input"type="file" name="profileImage" onchange="previewFile(this);">
                </div>
                <h3 class="fullname" style="float:left; margin-left:155px; width:70%; margin-top:-70px">whole name</h3>
                <p class="details" style="margin-top:-40px; margin-left:155px">your email</p>
                <!--not required - set defailt picture-->
                
            </div>

       <button class="btn btnStyling" type="submit" name="add_user">Confirm Details</button>
          
        </div><!--third-step-->
</form>
</div>

        </div><!--half1-->

        <div class='half2'>
            <a href="./register.php"><div class="btn-active">Register</div></a>
            <a href="./login.php"><div class="inactive-btn">Sign in</div></a>

            <div class='illustration'><img src="../assets/receptionist.png" width="600px"></div>
        </div><!--half2-->
    </div>

    <script>
        $(function(){
          $(".nextStep").on("click", function(){

            $(".form-container").scrollTop(440);
            $(".circle1").css("opacity","0.7")
            $(".circle2").css("opacity","1")
            $(".describe1").css("opacity","0.7");
            $(".describe2").css("opacity","1");



          });

          $(".nextUp2").on("click", function(){
            $(".form-container").scrollTop(880);
            $(".circle2").css("opacity","0.7")
            $(".circle3").css("opacity","1")
            $(".describe2").css("opacity","0.7");
            $(".describe3").css("opacity","1");

            var previewName = $(".fname").val();
            var previewSurname = $(".sname").val();
            var email = $(".email").val();

            $(".fullname").text(previewName+' '+previewSurname);
            $(".details").text(email);
          });

       

        });
    </script>
    </body>
</html>