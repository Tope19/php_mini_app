<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="datepicker/bootstrap-datepicker.css">
    <script src="datepicker/bootstrap-datepicker.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    require_once "database/database.php";
    $error = '';
    $img = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $first_name = $_POST["firstname"];
        $last_name = $_POST["lastname"];
        $address = $_POST["address"];
        $maritalstatus = $_POST["maritalstatus"];
        $subjects = $_POST["subjects"];
        $religion = $_POST["religion"];
        $image_temp = $_FILES["image"]["tmp_name"];
        $image_file = $_FILES["image"]["name"];
        $image_type = $_FILES["image"]["type"];
        // $img = file_get_contents($image);
        $path = "uploads/".$image_file;
        $date = $_POST["date"];
        

        if(
            empty($first_name) 
            || empty($last_name) 
            || empty($address)
            || empty($maritalstatus)
            || empty($subjects)
            || empty($religion)
            || empty($image_file)
            || empty($date)
        ){
             $error = '<div class="alert alert-danger">all fied is req</div>';  
        }else{
            if($image_type=="image/jpg" || $image_type=="image/jpeg" || $image_type=="image/png" || $image_type=="image/gif"){
                    if(!file_exists($path)){
                        move_uploaded_file($image_temp,"uploads/".$image_file);
                    }
                    else{
                        echo "already there";
                    }     
            }
            else{
                echo "must be JPG , JPEG , PNG & GIF FILE Format...";
            }

            // for($i=0; $i<sizeof($subjects); $i++)
            if(isset($_REQUEST["subjects"])){
                $subjects = implode(",",$_REQUEST["subjects"]);
            }

            $sql = "INSERT INTO application_form (firstname,lastname,address,maritalstatus,subjects,religion,image,date) VALUES (:firstname,:lastname,:address,:maritalstatus,:subjects,:religion,:image,:date)";
            $code = [
                'firstname' => $first_name,
                'lastname' => $last_name,
                'address' => $address,
                'maritalstatus' => $maritalstatus,
                'subjects' => $subjects,
                'religion' => $religion,
                'image' => $image_file,
                'date' => $date,
            ];
            if($stmt = $pdo->prepare($sql)){
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["firstname"] = $first_name;
                $_SESSION["lastname"] = $last_name;
                $_SESSION["address"] = $address;
                $_SESSION["maritalstatus"] = $maritalstatus;
                $_SESSION["subjects"] = $subjects;
                $_SESSION["religion"] = $religion;
                $_SESSION["image"] = $image_file;
                $_SESSION["date"] = $date;

                if($stmt->execute($code)){
                    header("location: confirm.php");
                }
            }
            
        }
    }


    

?>
    <div class="container mt-5 mb-5">
        <div class="alert"><?php echo $error ?></div>
        <a href="logout.php" class="btn btn-danger">Logout</a>
        <div class="row justify-content-center">
        <h2 class="text-center"><?php echo $_SESSION["code"] ?></h2>
            <div class="col-md-6 col-md-offset-6">
                <div class="card card-default">
                    <div class="card card-header">
                        <h2 class="text-center">Online Application</h2>
                        
                    </div>
                    <div class="card card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">   
                            <div class="form-group">
                                <label for="">First Name:</label>
                                <input type="text" name="firstname" class="form-control" >
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Last Name:</label>
                                <input type="text" name="lastname" class="form-control" >
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <Address>Address:</Address>
                                <input type="text" name="address" class="form-control" >
                                <span class="help-block"></span>
                            </div> 
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 col-md-12 pt-0">Marital Status:</legend>
                                  <div class="col-sm-10 col-md-12">
                                  <div class="form-check form-check-inline">
                                        <input type="radio" name="maritalstatus" class="form-check-input" value="single" >
                                        <label class="form-check-label">single</label>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="maritalstatus" class="form-check-input" value="married" >
                                        <label class="form-check-label">married</label>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="maritalstatus" class="form-check-input" value="complecated">
                                        <label class="form-check-label" >complecated</label>
                                        <span class="help-block"></span>
                                    </div>
                                  </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 col-md-12">Educationa Background:</legend>
                                    <div class="col-sm-10 col-md-12">
                                       <div class="form-check form-check-inline">
                                            <input type="checkbox" name="subjects[]" class="form-check-input" value="mathematics" >
                                            <label class="form-check-label">Mathematics</label>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="subjects[]" class="form-check-input" value="english" >
                                            <label class="form-check-label">English</label>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="subjects[]" class="form-check-input" value="science">
                                            <label class="form-check-label">Science</label>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="subjects[]" class="form-check-input" value="government" >
                                            <label class="form-check-label">Government</label>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="subjects[]" class="form-check-input" value="art" >
                                            <label class="form-check-label">Art</label>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="subjects[]" class="form-check-input" value="civic" >
                                            <label class="form-check-label">Civic</label>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="subjects[]" class="form-check-input" value="computer" >
                                            <label class="form-check-label">Computer</label>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="subjects[]" class="form-check-input" value="history" >
                                            <label class="form-check-label">History</label>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="subjects[]" class="form-check-input" value="agriculture" >
                                            <label class="form-check-label">Agriculture</label>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 col-md-12 pt-0">Religion:</legend>
                                  <div class="col-sm-10 col-md-12">
                                  <div class="form-check form-check-inline">
                                        <input type="radio" name="religion" class="form-check-input" value="islam" >
                                        <label class="form-check-label">Islam</label>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="religion" class="form-check-input" value="christian" >
                                        <label class="form-check-label">Christian</label>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="religion" class="form-check-input" value="traditional" >
                                        <label class="form-check-label">Tradional</label>
                                        <span class="help-block"></span>
                                    </div>
                                  </div>
                                </div>
                            </fieldset>
                            <div class="form-group dates">
                                <label>date:</label>
                                <input type="date" autocomplete="off" id="user1" name="date" class="form-control" >
                                <span class="help-block"></span>
                            </div> 
                            <div class="form-group dates">
                                <label>Image Upload:</label>
                                <input type="file" name="image" class="form-control" >
                                <span class="help-block"></span>
                            </div>   
                            <div class="form-group d-block">
                               <input type="submit" class="btn btn-primary" value="Submit Applicaion">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>
    <script>
        $(function(){
            $('.dates #user1').datepicker({
                'format':'yyy-mm-dd',
                'autoclose':true
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</body>
</html>