<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>photo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet"type="text/css"href="css/minireset.css">
    <link rel="stylesheet"type="text/css"href="css/favourPhoto.css">
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                <li><a href="browse.php"class="a">Browse</a></li>
                <li><a href="search.php"class="a">Search</a></li>
            </ul><!-- php -->
            <?php
            session_start();
            if(isset($_SESSION['username']) && !empty($_SESSION['username']) ){
                echo "<ul class='nav navbar-nav nav-pills navbar-right'>";
                echo "<li role='presentation' class='dropdown'>";
                echo "<a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button'aria-haspopup='true'aria-expanded='true'>My account <span class='caret'></span></a>";
                echo " <ul class='dropdown-menu'>";
                echo "<li><a href='upload.php'><i class='fa fa-upload''></i><span class='glyphicon glyphicon-upload'> </span> Upload</a></li>";
                echo "<li><a href='myUpload.php'><i class='fa fa-photo'></i><span class='glyphicon glyphicon-camera'> </span> My Photo</a></li>
                        <li><a href='avorite.php'><i class='fa fa-heart'></i><span class='glyphicon glyphicon-heart'> </span> My Favorite</a></li>
                        <li><a href='php/quit.php?name=quit'><i class='fa fa-sign-in'></i><span class='glyphicon glyphicon-log-out'> </span> Log Out</a></li>
                    </ul><!-- php -->
                </li>
            </ul>";
            }
            else{
                echo "<ul class='nav navbar-nav nav-pills navbar-right'>
                          <li><a href='login.php'>Log in</a></li>
                          <li><a href='register.php'>Register</a></li>
                      </ul>";
            }
            ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
    <h2>My Photo</h2>
    <form role="form"method="get">
    <div class="centre">
            <table class="picexhibit">
                <?php
                require_once ('config.php');
                require ('php/page.php');
                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                if(!empty($_SESSION['username'])){
                    $uid = $_SESSION['UID'];
                    $sql = "SELECT * FROM travelimage WHERE UID = '$uid' ";
                    $result = $pdo->query($sql);
                    $count = $result->rowCount();
                    if($count >= 20){
                        $total = 5;
                    }
                    else{
                        $total = Math.ceil($result / 4);
                    }
                    if(!isset($_GET['page'])){
                        $page = 1;
                    }
                    else{
                        $page = $_GET['page'];
                    }
                    showPages1($uid,$page,$total);

                }
                ?>
            </table>
    </div>
    </form>
<footer class="panel-footer">
    <p>&#169桃纸吧</p>
</footer>
</body>
</html>