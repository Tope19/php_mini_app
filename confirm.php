
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <?php

    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
?>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            
            <div class="col-md-6 col-md-offset-6">
                <div class="card card-default">
                    <div class="card card-header">
                         <!-- <img class="rounded-circle float-right" height="100" width="100" src="uploads/<?php echo $_SESSION["image"]?>" alt=""> -->
                         <h5>thank you!</h5>
                    </div>
                    <div class="card card-body">
                    
                       
                        <p>Dear <b><?php echo $_SESSION["firstname"]?> <?php echo $_SESSION["lastname"]?></b>,</p>
                        <p>Your application with the access code <b>"<?php echo $_SESSION["code"] ?>"</b> is successful. <br>
                             Kindly print Application status and Application Details by clicking the buttons bellow.
                        </p>
                        <p></p>

                        <div class="row">
                            <div class="col-md-6">
                             <a href="status.php" class="btn btn-primary">Application status</a>
                            </div>
                            <div class="col-md-6">
                             <a href="detail.php" class="btn btn-primary">Application Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
