<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>picture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet"type="text/css"href="css/minireset.css">
    <link rel="stylesheet"type="text/css"href="css/picture.css">
    <script type="text/javascript"src="js/kudos.js"></script>
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
<div class="centre">
    <?php
     require_once ('config.php');
     function showDetails(){
     $id = $_GET['id'];
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $sql = "SELECT * FROM travelimage WHERE ImageID = '$id'";
    $result = $pdo->query($sql);
    $row = $result->fetch();
    $country = $row['Country_RegionCodeISO'];
    $city = $row['CityCode'];
    $sql1 = "SELECT * FROM geocities WHERE GeoNameID = '$city'";//找城市
    $sql2 = "SELECT * FROM geocountries_regions WHERE ISO = '$country'";//找国家
    $resultCity = $pdo->query($sql1);
    $row1 = $resultCity->fetch();
    $resultCountry = $pdo->query($sql2);
    $row2 = $resultCountry->fetch();
    if($row['favour'] == null){
        $favour = 0;
    }
    else{
        $favour = $row['favour'];
    }
    echo '<div id="pic"><img src="travel-images/medium/';
    echo $row['Path'];
    echo '"></div><aside class="details"><dl><dt>Title</dt><dd>';
    echo $row['Title'];
    echo '</dd><dt>Content</dt><dd>';
    echo $row['Content'];
    echo '</dd><dt>Image ID</dt><dd id="imageid">';
    echo $row['ImageID'];
    echo '</dd><dt>Country City</dt><dd>';
    echo $row2['Country_RegionName'];
    echo $row1['AsciiName'];
    echo '</dd><dd id="Num>"';
    echo $favour;
    echo '</dd></dl></aside>';
}
   function showDescription(){
         $id = $_GET['id'];
       $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
       $sql = "SELECT * FROM travelimage WHERE ImageID = '$id'";
       $result = $pdo->query($sql);
       $row = $result->fetch();
       echo '<p>';
       echo $row['Description'];
       echo '</p>';
   }
    ?>


    <?php
    showDetails();
    ?>
    <aside class="details">
     <button i="kudos"onclick="kudos()"><img src="travel-images/hollowheart.jpg"></button>

</aside>
    <?php
    showDescription();
    ?>
</div>
<footer class="copyright">
    <p>&#169桃纸吧</p>
</footer>

</body>
</html>