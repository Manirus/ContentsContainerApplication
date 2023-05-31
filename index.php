<!DOCTYPE html>
<head>
<title>Login Form </title>
    <link rel="stylesheet" type="text/css" href="style.css">
<body>
    <div id="H1">
        <nav>
            <ul class="menu">
                <li> <a href="aboutus.html">ABOUT US</a></li>
                <li> <a href="contact.html">CONTACT</a></li>
               </ul> 
           </nav>     
    </div>

    <div class="box">
        <?php
        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $pwd = $_POST["password"];
            if(empty($email) OR empty($pwd)){
                echo "<div class='alert alert-danger'>Enter all required fields!!</div>";
            } else {
            require_once "database.php";
            $sql = "SELECT * from login_team_a where email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user){
                if(password_verify($pwd, $user["password"])){                 
                header("Location: Project1.php");
                die();
                } else {
                    echo "<div class='alert alert-danger'>Password is incorrect!!</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email doesnot exist!!</div>";
            }
        }
        }
        ?>
        <h1>Login Here</h1>

        <form name="mywork" action= "index.php" method = "POST">

            <p>Email</p>
            <input type="text" name="email" placeholder="Enter Email"> 

            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">

            <br><br>
             <div id="errorBox"> </div>
                <input type="submit" id="loginBtn" name="login" value="Login">           
             <br><br>
             <a href="register.php"> New Register </a>

        </form>
    </div>
</body>
</head>
</html>