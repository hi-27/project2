var container = document.getElementById('container');
var wrap = document.getElementById('wrap');
var list = document.getElementById('buttons').getElementsByTagName('span');
var count = 0;
var timer;
function right () {
    var x;
    if(wrap.style.left === "-3600px"){
        wrap.style.left = "-600px";
        x = -1200;
    }else{
        x = parseInt(wrap.style.left)-600;
    }
    var pos = parseInt(wrap.style.left);
    var timer1 = setInterval(frame, 5);
    function frame() {
        if (pos == x) {
            clearInterval(timer1);
        } else {
            pos -= 3;
            wrap.style.left = pos + "px";
        }
    }
    count++;
    if(count > 4){
        count = 0;
    }
    showList();
}
function left () {
    var x;
    if(wrap.style.left === "0px"){
        wrap.style.left = "-3000px";
        x = -2400;
    }else{
        x = parseInt(wrap.style.left)+600;
    }
    var pos = parseInt(wrap.style.left);
    var timer1 = setInterval(frame, 5);
    function frame() {
        if (pos == x) {
            clearInterval(timer1);
        } else {
            pos += 3;
            wrap.style.left = pos + "px";
        }
    }
    count--;
    if(count < 0){
        count = 4;
    }
    showList();
}
function showList(){
    for(var i = 0; i < list.length; i++){
        list[i].className = "";
    }
    list[count].className = "on";
}
function autoPlay() {
    timer = setInterval(right, 2000);
}
autoPlay();

container.onmouseover = function () {
    clearInterval(timer);
}


container.onmouseout = function () {
    autoPlay();
}

for (var i = 0; i < list.length; i++) {
    list[i].onclick = function () {
        clearInterval(timer);
        count = this.innerText - 1;
        if(this.innerText == 5){
            wrap.style.left = "0px";
        }
        else
            wrap.style.left = - this.innerText * 600 + "px";
        showList();
    }
}


var row = document.getElementById('row');
function refresh() {
    row.innerHTML = "<?php" +
        " <?php\n" +
        "    require_once(\"config.php\");\n" +
        "\n" +
        "    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);\n" +
        "    $sql = \"SELECT * FROM travelimage ORDER BY RANDOM LIMIT 6  \";\n" +
        "    $result = $pdo->query($sql);\n" +
        "    while ($row = $result->fetch()) {\n" +
        "        echo '<div class=\"col-md-4\">';\n" +
        "        echo '<a>';\n" +
        "        $img = '<img class=\"img-rounded\" src=\"travel-images/square-medium/'.$row['PATH'].'\">';\n" +
        "        echo $img;\n" +
        "        echo '</a>';\n" +
        "        echo '<caption><b>';\n" +
        "        echo $row['Title'];\n" +
        "        echo '</b></caption>';\n" +
        "        echo  '<P id=\"details\">';\n" +
        "        echo  $row['Description'];\n" +
        "        echo '</P>';\n" +
        "        echo '</div>';\n" +
        "    }\n" +
        "    ?>";
}