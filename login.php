<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登入</title>
    <meta name="viewpoint"content="width=device-width,initial-scale=1.0,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css"href="css/minireset.css">
    <link rel="stylesheet" type="text/css"href="css/login.css">
</head>
<body>
<fieldset class="fieldset">
    <form action='' method='post' role='form'>
    <h1 class="h1">Log In</h1>
        <?php
    session_start();
    $login = true;
    if(!$login)
        echo "<div class='lead'id='wrong'>you get wrong password or username.</div>";
        ?>
    <p class="code">Username：<input type="text"pattern="[a-zA-Z0-9\u4e00-\u9fa5]$" name="username" class="text" required></p>
    <p class="code">Password： <input type="password"pattern="[_a-zA-Z0-9]"required name="pword"class="text" ></p>
        <input type="submit"value="log in"name="submit"class="button">
    </p>
        <p style="display: inline">
            <a href="forget">forget your password?</a>
        <a href="register.php"class="a">No account?Sign up!</a>
    </p>
        <?php
  require_once("config.php");
     if(isset($_POST['submit'])){
                if(validLogin()){
                    $_SESSION['Username']=$_POST['username'];
                    $sql = "SELECT * FROM traveluser WHERE Username=:user and Password=:pass";
                    $statement->bindValue(':user',$_POST['username']);
                    $statement->bindValue(':pass',$_POST['pword']);
                    $result = $pdo->query($sql);
                    $row = $result->fetch();
                    $_SESSION['UID'] = $row['UID'];
                   header('location:index.php');
    }
    else{
        $login = false;
    }
     }
    function validLogin(){
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $sql = "SELECT * FROM traveluser WHERE Username=:user and Password=:pass";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':user',$_POST['username']);
        $statement->bindValue(':pass',$_POST['pword']);
        $statement->execute();
        if($statement->rowCount()>0){
            return true;
        }
        return false;
    }

        ?>
    </form>
</fieldset>
<footer>&#169桃纸吧</footer>
</body>
</html>