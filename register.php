<!DOCTYPE html>
<head>
<title>Register Form </title>
    <link rel="stylesheet" type="text/css" href="style.css">
<body>

    <div class="box">
        <?php
 if(isset($_POST["submit"])){
    $user = $_POST["uname1"];
    $email = $_POST["email"];
    $password1 = $_POST["password1"];
    $retypepassword = $_POST["password2"];

    $passwordhash = password_hash($password1, PASSWORD_DEFAULT);
    $errors = array();
    if(empty($user) OR empty($email) OR empty($password1)){
        array_push($errors, "Enter all required fields");
    }else {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Email is invalid");
    }
    if($password1 !== $retypepassword){
        array_push($errors,"Password doesnot match");
    }
    require_once "database.php"; 
    $sql = "SELECT * FROM login_team_a WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result);
    if($rowcount>0){
        array_push($errors, "Email already exists!");
    }
}
   
    
    if(count($errors)>0){
        foreach($errors as $error){
            echo "<div class = 'alert alert-danger'>$error</div>";
        }
    } else {
        require_once "database.php";   
        $sql = "INSERT INTO login_team_a (username, email, password) VALUES ( ?, ?, ? )";
        $stmt = mysqli_stmt_init($conn);
        $preparestmt = mysqli_stmt_prepare($stmt, $sql);
        if($preparestmt){
            mysqli_stmt_bind_param($stmt, "sss", $user, $email, $passwordhash);
            mysqli_stmt_execute($stmt);
            echo "<div class = 'alert alert-danger'> You are registered successfully</div>";
        } else {
            die("Something went wrong !!!!");
        }
    }
 }
?>
        <h1>Register Here</h1>

        <form method="post" action="register.php">

            <p>Username</p>
            <input type="text" name="uname1" placeholder="Enter Username">

            <p>Email</p>
            <input type="text" name="email" placeholder="Enter email id">

            <p>Password</p>
            <input type="password" name="password1" placeholder="Enter Password">

            <p>Retype Password</p>
            <input type="password" name="password2" placeholder="Re-Enter Password">

             <div id="errorBox"></div>
            <input type="submit" name="submit" value="Register">

            <br><br>
            <a href="index.php">Existing user</a>
        </form>
        
    </div>

</body>
</head>
</html>