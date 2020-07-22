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
    require_once "database/database.php";

?>  

 <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-6">
            <div class="card card-default">
                <div class="card card-body p-5">

                   <div class="text-center mb-3 p-2 "> <img class="rounded border border-dark d-block mx-auto" height="100" width="100" src="uploads/<?php echo $_SESSION["image"]?>" alt=""></div> 
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-group list-group-horizontal mb-2">
                                <li class="list-group-item d-flex justify-content-between align-items-center mr-2"></li>
                                <li class="list-group-item ">  </li>
                            </ul>
                           
                            
                           
                            
                            
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-horizontal mb-2">
                                    <li class="list-group-item mr-2"><b>Address:</b></li>  
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group">
                                <li class="list-group-item"> <p><?php echo $_SESSION["maritalstatus"]?></p>  </li>
                                </ul>
                            </div>
                        </div>
                    <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-horizontal mb-2">
                                    <li class="list-group-item mr-2"><b>Marital Status:</b></li>  
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group">
                                <li class="list-group-item"> <p><?php echo $_SESSION["maritalstatus"]?></p>  </li>
                                </ul>
                            </div>
                        </div>
                    <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-horizontal mb-2">
                                    <li class="list-group-item mr-2"><b>Eductional Background:</b></li>  
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group">
                                <li class="list-group-item"> <p>N/A</p>  </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-horizontal mb-2">
                                    <li class="list-group-item mr-2"><b>Best subjects:</b></li>  
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group">
                                <li class="list-group-item"> <p><?php echo $_SESSION["subjects"]?></p>  </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"> <ul class="list-group list-group-horizontal mb-2">
                                <li class="list-group-item d-flex justify-content-between align-items-center mr-2"><b>Religion:</b></li>
                                
                            </ul></div>
                            <div class="col-md-6"><ul class="list-group">
                            <li class="list-group-item "> <?php echo $_SESSION["religion"]?>  </li>
                            </ul></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"> <ul class="list-group list-group-horizontal mb-2">
                                <li class="list-group-item d-flex justify-content-between align-items-center mr-2"><b>State of origin:</b></li>
                                
                            </ul></div>
                            <div class="col-md-6"><ul class="list-group">
                            <li class="list-group-item "> N/A </li>
                            </ul></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"> <ul class="list-group list-group-horizontal mb-2">
                                <li class="list-group-item d-flex justify-content-between align-items-center mr-2"><b>Date of birth:</b></li>
                                
                            </ul></div>
                            <div class="col-md-6"><ul class="list-group">
                            <li class="list-group-item "> <?php echo $_SESSION["date"]?> </li>
                            </ul></div>
                        </div>
                        
                    
                    <!-- <p>I <b><?php echo $_SESSION["firstname"]?> <?php echo $_SESSION["lastname"]?></b>, Applied with the appplication Access code <b>"<?php echo $_SESSION["code"] ?>"</b>
                    <br>
                    I live at <b><?php echo $_SESSION["address"] ?></b> and i was born on <b><?php echo $_SESSION["date"] ?></b>
                    <br>
                    My favorite subjects are <b>:</b> <b><?php echo $_SESSION["subjects"] ?></b>
                    </p> -->
                </div>
            </div>
        </div>
    </div>
 </div>
</body>
</html>
