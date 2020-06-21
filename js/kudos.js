function kudos() {
    var target = document.getElementById('Num');
    var pic = document.getElementById('kudos');
    var num = target.innerHTML;
    var id = document.getElementById('imageid');
    num++;
    target.innerHTML = num;
    pic.innerHTML=" <img src='travel-images/heart.jpg'> ";
    var change = '$sql = "UPDATE travelimages SET favour =' + num +" WHERE ImageID = " + id;
    document.write('?php' + '$con = mysqli_connect("localhost","winter","abc","travel_new");' +'mysqli_query($con,'+ change + ');'+
        'mysqli_close($con);' + '?>');


}

// 检测连接
