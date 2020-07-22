<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>

<?php
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: apply.php");
        exit;
    }

    require_once "database/database.php";

    $username = $password = "";
    $username_err = $password_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $username_err = "please enter username";
        } else{
            $username = trim($_POST["username"]);
        }
        if(empty(trim($_POST["password"]))){
            $password_err = "please enter password";
        } else{
            $password = trim($_POST["password"]);
        }

        if(empty($username_err) && empty($password_err)){
            $sql = "SELECT id, username,password FROM users WHERE username = :username";

            if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":username",$param_username, PDO::PARAM_STR);
                $param_username = trim($_POST["username"]);

                if($stmt->execute()){
                    if($stmt->rowCount() == 1){
                        if($row = $stmt->fetch()){
                            $id = $row["id"];
                            $username = $row["username"];
                            $password = $row["password"];

                            if(!$password == $row["password"]){
                                session_start();

                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;

                                header("location: apply.php");
                            }else{
                                $password_err = "the password no correct";
                            }
                        }
                    }else{
                        $username_err = "user no dey here";
                    }
                }else{
                    echo "something don happen!!!";
                }
                unset($stmt);
            }
        }
        unset($pdo);
    }
?>
   <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-6">
                <div class="card card-default">
                    <div class="card card-header">
                        <h2 class="text-center">Login</h2>
                    </div>
                    <div class="card card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">   
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <label for="">Username:</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                                <span class="help-block"><?php echo $username_err; ?></span>
                            </div> 
                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label for="">Password:</label>
                                <input type="password" name="password" class="form-control">
                                <span class="help-block"><?php echo $password_err; ?></span>
                            </div>   
                            <div class="form-group">
                               <input type="submit" class="btn btn-primary" value="login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>


</body>
</html>
