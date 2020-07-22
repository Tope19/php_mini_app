<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

    <style>
        .has-error{
            color:red;
        }
    </style>
</head>
<body>
<?php 
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: apply.php");
        exit;
    }
    require_once "database/database.php";

    $code = "";
    $code_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["code"]))){
            $username_err = "please enter the code";
        } else{
            $code = trim($_POST["code"]);
        }

        if(empty($code_err)){
            $sql = "SELECT * FROM access_code WHERE code = ?";

            if($stmt = $pdo->prepare($sql)){
                if($stmt->execute([$code])){
                    if($stmt->rowCount() == 1){
                        if($row = $stmt->fetch()){
                           if($code = $row["code"]){

                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["code"] = $code;
                                header("location: apply.php");
                                exit;
                           }else{ header("location: error.php");}
                        }
                }else{
                    $code_err = "the code no correct";
                }
            }
        }
    }
}

?>
   <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-6">
                <div class="card card-default">
                    <div class="card card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">   
                            <div class="form-group <?php echo (!empty($code_err)) ? 'has-error' : ''; ?>">
                                <label for="">Access Code:</label>
                                <input type="text" value="<?php echo $code; ?>" name="code" class="form-control">
                                <span class="help-block"><?php echo $code_err; ?></span>
                            </div>
                            <input type="submit" value="check" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>
</body>
</html>