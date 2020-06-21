<?php
require_once('config.php');
  function showPages($key, $type, $page, $total){
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $minRow = ($page - 1) * 16;
      $maxRow = $page * 16;
      if($type === 0){
          $sql = "SELECT * FROM travelimage WHERE CityCode ='$key'LIMIT '$minRow', '$maxRow'";
      }
      else if (type === 1){
          $sql = "SELECT * FROM travelimage WHERE  Content = '$key' ";
      }
      $result = $pdo->query($sql);
      while ($row = $result->fetch()){
          echo '<div class="col-md-4">';
          echo '<a>';
          echo '<img class="img-rounded" src="travel-images/square-medium/';
          echo $row['PATH'];
          echo '"></a><br>';
          echo '</a>';
          echo '</div>';
      }
      showNum($page, $total);
  }
function showPages1($key, $page, $total){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $minRow = ($page - 1) * 4;
    $maxRow = $page * 4;
        $sql = "SELECT * FROM travelimage WHERE UID ='$key'LIMIT '$minRow', '$maxRow'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $id = $row['ImageID'];
        echo '<td><a href="../picture.php?id='.$id.'"><img src="../travel-images/square-medium/'.$row['PATH'].'"></a></td>';
        echo '<td><p>'.$row['Description'].'</p>';
        echo '<form action="change.php?id='.$id.'"role="form"method="post">';
        echo '<input type="submit"value="modify"class="modify">';
        echo '<input type="submit"value="delete"class="delete">';
        echo '</form>';
        echo '</td></tr>';
    }
    showNum($page, $total);
}
function showPages2($key, $page, $total){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $minRow = ($page - 1) * 4;
    $maxRow = $page * 4;
    $sql = "SELECT * FROM travelimagefavour WHERE UID ='$key'LIMIT '$minRow', '$maxRow'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $id = $row['ImageID'];
        echo '<td><a href="../picture.php?id='.$id.'"><img src="../travel-images/square-medium/'.$row['PATH'].'"></a></td>';
        echo '<td><p>'.$row['Description'].'</p>';
        echo '<form action="change.php?id='.$id.'"role="form"method="post">';
        echo '<input type="submit"value="delete1"class="delete1">';
        echo '</form>';
        echo '</td></tr>';
    }
    showNum($page, $total);
}
function showPages3($key, $type, $page, $total){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $minRow = ($page - 1) * 4;
    $maxRow = $page * 4;
    if($type === 0){
        $sql = "SELECT * FROM travelimage WHERE Description LIKE %'.$key.'% 'LIMIT '$minRow', '$maxRow";
    }
    else if (type === 1){
        $sql = "SELECT COUNT (*) FROM travelimage WHERE Title LIKE %'.$key.'%  'LIMIT '$minRow', '$maxRow";
    }
    $result = $pdo->query($sql);
        while ($row = $result->fetch()){
            $id = $row['ImageID'];
            echo '<td><a href="../picture.php?id='.$id.'"><img src="../travel-images/square-medium/'.$row['PATH'].'"></a></td>';
            echo '<td><p>'.$row['Description'].'</p>';
            echo '<form action="change.php?id='.$id.'"role="form"method="post">';
            echo '<input type="submit"value="delete1"class="delete1">';
            echo '</form>';
            echo '</td></tr>';
        }
        showNum($page, $total);

}
function showNum($now, $total){
    if($_SERVER['REQUEST_METHOD'] === 'post'){
        for($x = 0; $x <= $total; $x++){
            echo '<footer class="num">';
            echo '<p>';
            echo '<a href="../' . $_SERVER["SCRIPT_NAME"] . '?page= '.$x.' ">';
            if($now === $x){
                echo '<ins>';
                echo $now;
                echo "</ins>";
            }
            echo '</a>';
            echo '</p>';
            echo '</footer>';
        }
    }
}