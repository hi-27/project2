<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet"type="text/css"href="css/minireset.css">
    <link rel="stylesheet"type="text/css"href="css/upload.css">
    <script type="text/javascript"src="js/file.js"></script>
</head>
<body>
<?php
require_once('config.php');
$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
$tit = "";
$ci="";
$cou="";
$des = "";
$con = "";
if (!empty($_POST['modify'])){
$id = $_POST['id'];
$uid = $_SESSION['UID'];
$sql = " SELECT * FROM traveimage WHERE ImageID = '.$id.' and UID ='.$uid'";
$result = $pdo->query($sql);
$rows = $result->fetch();
$tit = $rows['Title'];
$des = $rows['Description'];
$con = $rows['Content'];
$cc = $rows['CityCode'];
$cci = $rows['CountryCodeISO'];
$sql4 = "SELECT AsciiName FROM geocities WHERE GeoNameID ='.$cc.' LIMIT 1";
$sql5 = "SELECT Country_RegionName FROM geocountries_regions WHERE ISO='.$cci.' LIMIT 1";
    $result4 = $pdo->query($sql4);
    $ci = $result->fetch();
    $result5 = $pdo->query($sql5);
    $cou = $result->fetch();
    $con = mysqli_connect("localhost","winter","abc","travel_new");
    if (mysqli_connect_errno())
    {
        echo "连接失败: " . mysqli_connect_error();
    }
    $sql6 = "DELETE FROM travelimage WHERE ImageID='.$id.'";
    mysqli_query($con,$sql6);
    mysqli_close($con);

}
?>
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
                      </ul>";
            }
            ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<form method="get"role="form">
    <div class="centre">
        <div class="picture">
            <img src=""alt="image preview"id="pic">
            <input type="file"accept="image/jpeg, image/png, image/gif"value="upload"id="upload"name="src"onchange="upload()">
        </div>
        <div class="word">
            <p>
                Title:<br>
                <input type="text"name="title"class="text"<?php
                   echo 'placeholder="'.$tit.'"';
                ?>required>
            </p>
            <p>
                Description:<br>
                <textarea rows="3"name="description" class="text"required<?php
                   echo 'placeholder="'.$des.'"';
                ?>></textarea>
            </p>
            <p>
                Country:<br>
                <input type="text"name="country"class="text" <?php
                       echo 'placeholder="'.$cou.'"';
                       ?>required>
            </p>
            <p>
                City:<br>
                <input type="text"name="city"class="text"<?php
                echo 'placeholder="'.$ci.'"';
                ?> required>
            </p>
            <p>
                Content:<br>
                <select name="content"required><option selected="selected"><?php
                        echo $con;
                        ?></option>
                    <option value="cathedral">cathedral</option>
                    <option value="scenery">scenery</option>
                    <option value="square">square</option>
                    <option value="meadow">meadow</option></select>
            </p>
            <input type="submit"value="submit""id="submit">
        </div>
    </div>
</form>
<?php

if($_SERVER['REQUEST_METHOD'] === 'get'&& !empty($_POST['src'])){
    $path = substr(strrchr($_GET['src'], "/"), 1);
    $title = $_GET['title'];
    $description = $_GET['description'];
    $city = $_GET['city'];
    $country = $_GET['country'];
    $content = $_GET['content'];
    $sql1 = "SELECT GeoNameID FROM geocities where AsciiName = '$city' LIMIT 1";
    $cityID1 = $pdo->query($sql1);
    $cityID = $cityID1->fetch();
    $sql2 = "SELECT ISO FROM geocountries_regions where Country_RegionName = '$country' LIMIT 1";
    $countryID1 = $pdo->query($sql2);
    $countryID = $cityID1->fetch();
    $uid = $_SESSION['UID'];
    $sql3 = "INSERT INTO travelimage (Title, Description, CityCode, Country_RegionCodeISO, UID, Content) VALUES ('$title'.'$description','$cityID', '$countryID', '$uid', '$content')";
    $con=mysqli_connect("localhost","winter","abc","travel_new");
    if (mysqli_connect_errno())
    {
        echo "连接失败: " . mysqli_connect_error();
    }

    mysqli_query($con,$sql3);
    mysqli_close($con);
}
?>
<footer class="panel-footer">
    <p>&#169桃纸吧</p>
</footer>
</body>
</html>
