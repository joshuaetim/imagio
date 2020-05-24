<?php
    session_start();
    require __DIR__.'/vendor/autoload.php';

    // $conn = mysqli_connect('localhost', 'root', '');
    // if(!$conn){
    //     die('Connection failed');
    // }
    // else{
    //     die('Connection good');
    // }
    $username = '';

    if(isset($_POST['login'])){
        $error = '';
        $auth = new Auth;
        $stats = $auth->getConnect();
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(empty($username) || empty($password)){
            $error = 'Fields must be filled up';
        }
        else{
            $login = $auth->loginUser($username, $password);
            if($login == 1){
                $_SESSION['user'] = $username;
                //$error = "yes";
                header("Location: index");

            }
            else{
                $error = 'Username or password incorrect';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/bootstrap.js"></script>
    <title>Login Here</title>
</head>
<body>
    <div class="container">
        <div class="card form">
            <p>
                <?php
                    if(isset($error)){
                         echo $error;
                    }
                    if(isset($_SESSION['login_error'])){
                        echo $_SESSION['login_error'];
                        unset($_SESSION['login_error']);
                    }
                ?>
            </p>
            <h2 class="container">Login</h2>
            <div class="row">
                <div class="col-md-8 justify-content-center">
                    <form action="login.php" class="container" method="POST">
                        <div class="form-group">
                            <label for="email">Username</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter email" name="username" value="<?=$username?>">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember"> Remember me
                            </label>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit" name="login">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>