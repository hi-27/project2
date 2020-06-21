<?php
error_reporting(0);   //防止出现Notice报错，阻断网页运行
session_start();
      //使用GET获取name，判断是否满足条件
    unset($_SESSION['username']);      //重置session
    header('location:index.php');     //跳转到主页面

?>