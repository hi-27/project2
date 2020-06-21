<html lang="en">
<head>

    <!-- Latest compiled and minified Bootstrap Core CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link href="css/index.css"rel="stylesheet"type="text/css">
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>index</title>
</head>
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
<div id="container">
    <div id="wrap" style="left:-600px;">
        <img src="travel-images/medium/5855174537.jpg" alt="5">
        <img src="travel-images/medium/5855752464.jpg" alt="1">
        <img src="travel-images/medium/5856697109.jpg" alt="2">
        <img src="travel-images/medium/6592317633.jpg" alt="3">
        <img src="travel-images/medium/9496560520.jpg" alt="4">
        <img src="travel-images/medium/5855174537.jpg" alt="5">
        <img src="travel-images/medium/5855752464.jpg" alt="1">
    </div>
    <div id="buttons">
        <span class="on">1</span>
        <span>2</span>
        <span>3</span>
        <span>4</span>
        <span>5</span>
    </div>
    <a href="javascript:" class="arrow arrow_left"onclick="left()">&lt;</a>
    <a href="javascript:" class="arrow arrow_right"onclick="right()">&gt;</a>
</div>
<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
<script src="js/index.js"></script>
<div class="container"id="pictures">
    <div class="row"id="row">
    <?php
    require_once("config.php");

    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $sql = "SELECT * FROM travelimage ORDER BY favour DESC LIMIT 6  ";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()) {
        echo '<div class="col-md-4">';
        echo '<a href="picture.php?id='.$row['ImageID'].'">';
        echo '<img class="img-rounded" src="travel-images/square-medium/';
        echo $row['PATH'];
        echo '"></a><br>';
        echo '<caption><b>';
        echo $row['Title'];
        echo '</b></caption>';
        echo  '<P id="details">';
        echo  $row['Description'];
        echo '</P>';
        echo '</div>';
    }
    ?>
</div>
</div>
<button id="up" class="btn-xs" onclick="window.location.href='#'"><span class='glyphicon glyphicon-arrow-up'></span></button>
<button id="refresh"class="btn-xs" onclick="alert('refresh')"><span class="glyphicon glyphicon-refres"></span></button>
<footer>

    <div id="copyrightRow">
        <div class="container">
            <div class="row">
                <p class="copyright">Copyright © travel 桃纸吧</p>
            </div>
        </div>
    </div>
</footer>

</html>