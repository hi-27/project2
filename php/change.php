<?php
if($_SERVER['REQUEST_METHOD'] == 'post'){
    $id = $_POST['id'];
   if(!empty($_POST['modify'])){
       header('upload.php?id='.$id.'"');
   }
   else if(!empty($_POST['delete'])){
       $con = mysqli_connect("localhost","winter","abc","travel_new");
       if (mysqli_connect_errno())
       {
           echo "连接失败: " . mysqli_connect_error();
       }
       $sql = "DELETE FROM travelimage WHERE ImageID='.$id.'";
       mysqli_query($con,$sql);
       mysqli_close($con);
       header('myphoto.php');
   }
   else if(!empty($_POST['delete1'])){
       $con = mysqli_connect("localhost","winter","abc","travel_new");
       if (mysqli_connect_errno())
       {
           echo "连接失败: " . mysqli_connect_error();
       }
       $sql = "DELETE FROM travelimagefavour WHERE ImageID='.$id.'";
       mysqli_query($con,$sql);
       mysqli_close($con);
       header('myfavour.php');
   }
}