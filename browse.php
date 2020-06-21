<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>browse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet"type="text/css"href="css/minireset.css">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet"href="css/browse.css">
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
<div>
  <table class="filter">
      <form method="get"role="form">
      <td>theme：<select name="theme" id="theme">
          <option>--select content--</option>
          <option value="cathedral">cathedral</option>
          <option value="scenery">scenery</option>
          <option value="square">square</option>
          <option value="meadow">meadow</option>
      </select></td>

      <td>country：<select name="country" id="country">
              <option>--select country--</option>
              <option value="CN">China</option>
              <option value="EG">Egypt</option>
              <option value="DK">Denmark</option>
              <option value="FR">France</option>
              <option value="FI">Finland</option>
      </select>
      </td>
      <td>city：<select name="city" id="city">
          </select>
      </td>
          <script>
              $(function(){
                  //初始化数据
                  var url = 'address.php'; //后台地址
                  $("#country").change(function(){  //监听下拉列表的change事件
                      var address = $(this).val();  //获取下拉列表选中的值
                      //发送一个post请求
                      $.ajax({
                          type:'post',
                          url:url,
                          data:{key:address},
                          dataType:'json',
                          success:function(data){  //请求成功回调函数
                              var status = data.status; //获取返回值
                              var address = data.data;
                              if(status == 200){  //判断状态码，200为成功
                                  var option = '';
                                  for(var i=0;i<address.length;i++){  //循环获取返回值，并组装成html代码
                                      option +='<option value=' + address[i] +'>'+address[i]+'</option>';
                                  }
                              }else{
                                  var option = '<option>--select city--</option>';  //默认值
                              }

                              $("#city").html(option);  //js刷新第二个下拉框的值
                          },
                      });
                  });
              });
          </script>

<td><input type="submit"value="filter"name="submit"class="btn-primary"></td>
      </form><!--三级联动筛选-->
  </table>
</div><!--二级筛选 -->
<aside>
    <div class="aside">
        <input type="text"placeholder="filter by title"><input type="button"value="filter">
    </div>
    <div class="aside">
       <dl>
         <dt>hot country</dt>
           <dd><a href="browse.php">China</a></dd>
           <dd><a href="browse.php">Japan</a></dd>
           <dd><a href="browse.php">Australia</a></dd>
           <dd><a href="browse.php">Greece</a></dd>
       </dl>
    </div>
    <div class="aside">
       <dl>
            <dt>hot theme</dt>
            <dd><a href="browse.php">meadow</a></dd>
            <dd><a href="browse.php">cathedral</a></dd>
            <dd><a href="browse.php">tower</a></dd>
            <dd><a href="browse.php">square</a></dd>
            <dd><a href="browse.php">scenery</a></dd>
       </dl>
    </div>
</aside>
<div class="centre">
    <div id="pictures" class="container">
        <div class="row">
            <?php
            require_once('config.php');
            require('php/page.php');
            global $total1, $total2;

            if($_SERVER['REQUEST_METHOD'] == "get" && !empty($_GET['city'])){
                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                $cityName = $_GET['city'];
                if(!empty($cityName)){
                    $sql1 = "SELECT * FROM geocities WHERE AsciiName = $cityName LIMIT 1 ";
                    $result = $pdo->query($sql1);
                    $row = $result->fetch();
                    $id = $row['GeoNameID'];
                    $sql1 = "SELECT COUNT(*) FROM travelimage WHERE CityCode = $id";
                    $result1 = $pdo->query($sql1);
                    if($result1 >= 80){
                        $total1 = 5;
                    }
                    else{
                        $total1 = Math.ceil($result / 16);
                    }
                    if(!isset($_GET['page'])){
                        $page = 1;
                    }
                    else{
                        $page = $_GET['page'];
                    }
                    showPages($id, 0,$page,$total1);
                }
            }
            //theme
            if($_SERVER['REQUEST_METHOD'] == "get" && !empty($_GET['theme'])){
                $theme = $_GET['theme'];
                $sql1 = "SELECT COUNT (*) FROM travelimage WHERE  Content = '$theme' ";
                $result1= $pdo->query($sql1);
                if($result1 >= 80){
                    $total2 = 5;
                }
                else{
                    $total2 = Math.ceil($result / 16);
                }
                if(!isset($_GET['page'])){
                    $page = 1;
                }
                else{
                    $page = $_GET['page'];
                }
                showPages($theme, 1,$page,$total2);
            }
            ?>
        </div>
    </div>

</div>
<footer class="copyright">
    <p>&#169桃纸吧</p>
</footer>

</body>
</html>

