<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register</title>
    <link rel="stylesheet"type="text/css"href="css/minireset.css">
    <link rel="stylesheet"type="text/css"href="css/register.css">
</head>
<body>
<h1>Sign up</h1>
<fieldset >
    <form action="#"method="post">
        <p>
            Username<br>
            <input type="text"name="username"size="40" pattern="^[_a-zA-Z0-9]{1,}$" class="text"required>
        </p>
        <p>
            Password:<br>
            <input type="password" name="password"size="40"placeholder="at least 8 digits"pattern="[a-zA-Z0-9]{8,}$"class="text"  required>
        </p>
        <p>
            Confirm:<br>
            <input type="password" name="repassword"size="40"placeholder="at least 8 digits"pattern="[a-zA-Z0-9]{8,}$"class="text" required>
        </p>
        <p>
          E-mail Address:<br>
            <input type="email" name="email"size="40"pattern="[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)$"class="text"  required>
        </p>
        <p>
            Please read the following clauses carefully.</p>
        <p>
    <textarea rows="5"cols="80"disabled>After your signing up successfully，Mostie will give the user his(her) own account. The user should take care of his own account including the
        username and the password.The behavior of the user on the platform should be legal.User must take the full legal responsibility on the accuracy of the information provided
        during the process of signup.User mustn't disguise or
    ⽤户须对在墨斯缇的注册信息的真实性、合法性、有效性承担全部责任，⽤户不得冒充他⼈；不得利⽤他⼈的名义发布任何信息；不得恶意使⽤注册帐号导致其他⽤ 户误认；否则墨斯缇有权⽴即
    停⽌提供服务，收回其帐号并由⽤户独⾃承担由此⽽产⽣的⼀切法律责任。 ⽤户直接或通过各类⽅式（如 RSS 源和站外 API 引⽤等）间接使⽤墨斯缇服务和数据的⾏为，都将被视作已⽆条件接受本协议全部
    内容；若⽤户对本协议的任何 条款存在异议，请停⽌使⽤墨斯缇所提供的全部服务。 墨斯缇是⼀个信息分享、传播及获取的平台，⽤户通过知乎发表的信息为公开的信息，其他第三⽅均可以通过墨斯缇获取⽤户发
    表的信息，⽤户对任何信息的发表即认 可该信息为公开的信息，并单独对此⾏为承担法律责任；任何⽤户不愿被其他第三⼈获知的信息都不应该在墨斯缇上进⾏发表。 ⽤户承诺不得以任何⽅式利⽤墨斯缇直接或
    间接从事违反中国法律以及社会公德的⾏为，知乎有权对违反上述承诺的内容予以删除。
    ⽤户不得利⽤知乎服务制作、上载、复制、发布、传播或者转载如下内容：
   反对宪法所确定的基本原则的； 危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统⼀的； 损害国家荣誉和利益的； 煽动⺠族仇恨、⺠族歧视，破坏⺠族团结的； 侮辱、滥⽤英烈形象，否定英烈事迹,
   美化粉饰侵略战争⾏为的； 破坏国家宗教政策，宣扬邪教和封建迷信的； 散布谣⾔，扰乱社会秩序，破坏社会稳定的； 散布淫秽、⾊情、赌博、暴⼒、凶杀、恐怖或者教唆犯罪的； 侮辱或者诽谤他⼈，侵害
   他⼈合法权益的； 含有法律、⾏政法规禁⽌的其他内容的信息。 所有⽤户同意遵守知乎社区管理规定（试⾏）和墨斯缇图片服务协议（试⾏）。 机构⽤户同意遵守知乎机构号服务协议，以及知乎机构号使⽤规范
   （试⾏）。 知乎有权对⽤户使⽤墨斯缇的情况进⾏审查和监督，如⽤户在使⽤知乎时违反任何上述规定，墨斯缇或其授权的⼈有权要求⽤户改正或直接采取⼀切必要的措施（包括 但不限于更改或删除⽤户张贴的内容、
   暂停或终⽌⽤户使⽤知乎的权利）以减轻⽤户不当⾏为造成的影响。 " </textarea><br>
            <input type="radio"name="agreement"value="agree"required>I have read it carefully.
        </p>
        <p>
            Verification Code:tan90 = <br>
            <input type="text"name="validate" class="text" required><br>
            <code>To prove you're not a robot.</code>
        </p>
        <p>
            <input type="submit"value="sign"class="button">
        </p>
    </form>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'post' && !empty($_POST['sign'])){
        if($_POST['password'] === $_POST['repassword']){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
            $_SESSION['Username']=$username;
            $sql = "INSERT INTO traveluser ( Email, Username, Pass)";
            $con = mysqli_connect("localhost","winter","abc","travel_new");
            if (mysqli_connect_errno())
            {
                echo "连接失败: " . mysqli_connect_error();
            }
            mysqli_query($con,$sql);
            mysqli_close($con);
            header('location:index.php');
        }
        else{
            echo '<script type="text/javascript"rel="script">';
            echo 'alert("Defferent Password")';
            echo '</script>';

        }
    }
    ?>
</fieldset>
</body>
</html>