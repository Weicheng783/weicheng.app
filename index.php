<html>
    <head>
        <link rel="icon" type="image/x-icon" href="./favicon.ico" />
        <meta charset="utf-8">
        <title>Weicheng Space 2022</title>
        <!-- Optimised for mobile users -->
        <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    </head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

    <body style="background-color: antiquewhite;">
        <div id='header_group' style="display:block; text-align: center;">
            <p class="narrator" style="font-size: x-large; text-align: center; " id="ymd"></p>
            <button id="follow" class="header_button" onclick="window.location.href='https://github.com/weicheng783'">Follow Me on Github</button>

            <?php
                date_default_timezone_set('Europe/London');
                $current_date = date('Y/m/d H:i:s');
                echo '<p class="narrator" style="font-size: large; text-align: center; ">英国时间: <strong id="serverYMD">'.$current_date.'</strong>.</p>';
            ?>

            <?php
                if(!isset($_COOKIE['user']) or $_COOKIE['user'] == null or $_COOKIE['user'] == ""){
                    echo '<p class="narrator" style="font-size: medium; text-align: center; ">站点已经启用单点登录认证(Single Sign-On)，请知悉。</p>';
                    echo '<form action="login.php" method="post" class="narrator" style="font-size: medium; text-align: center; ">
                            <p>用户: <input name="name" class="narrator" style="font-size: medium; text-align: center; "></input></p>
                            <p>密码: <input type="password" name="password"></input></p>
                            <button type="submit" class="header_button" onclick="">进入</button>
                            </form>';
                    echo '<button class="header_button" onclick="location.href=\'signin.php\';">重置密码/注册</button>';

                }else{
                    echo '<img src="./logo_2022.png" id="logo" alt="Weicheng_Space_Welcome_Message" style=" text-align: left; border-radius:20px; display:inline-block; height:100px; width:auto;">
                    <img src="./logo.png" id="logo" alt="Weicheng_Space_Welcome_Message" style=" text-align: left; border-radius:20px; display:inline-block; height:100px; width:auto;">';

                    echo '<p class="narrator" style="font-size: medium; text-align: center; "><strong>'.$_COOKIE['user'].'</strong>，你好。</p>';

                    echo '<p class="narrator" style="font-size: x-large; text-align: center; ">#曼城少年，追光向前🌈</p>';
                    echo '<p class="narrator" style="font-size: x-large; text-align: center; ">#23年英硕进入备战倒计时🌈 All in!</p>';

                    $total_count = shell_exec("git rev-list --all --count 2>&1");
                    echo '<p class="narrator" style="font-size: medium; text-align: center; border-radius: auto; background-origin: padding-box;">总版本迭代号: <strong>#'.$total_count.'</strong></p>';

                    echo '<p><button id="cv" class="header_button" onclick="window.location.href=\'https://weicheng.app/cv.pdf\'">CV / RESUME / 个人简历</button></p>';
                    echo '<p class="narrator" style="font-size: x-large; text-align: center; "><button id="cv" class="header_button" onclick="window.location.href=\'https://weicheng.app/posts.php\'">看看最近的更新和照片🙃</button></p>';
                    echo '<img src="./2223allin.jpeg"  alt="make it possible" style=" text-align: left; border-radius:20px; display:inline-block; height:auto; width:80%;">';
    

                    // Source Control Information Display
                    $gitweb = "https://github.com/Weicheng783/weicheng.app/";
            
                    $branch_name = shell_exec('git branch --show-current 2>&1');
                    $hash = shell_exec('git rev-parse --short HEAD 2>&1');
                    $commit_msg = shell_exec('git log -1 --pretty=format:%B 2>&1');
                    $last_updated_time = shell_exec('git log -1 --format=%cd 2>&1');
                    $git_author = shell_exec("git log -1 --pretty=format:'%an (%ae)' 2>&1");
            
                    echo '<hr/>';
                    echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">⚠️Repo currently private. ⚠️本代码仓库暂不对外开放。</p>';
            
                    echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">☞ [Source Code Management / 代码管理]</p>';
                    echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">最近一次更新(last updated time): <strong>'.$last_updated_time.'</strong></p>';
                    echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">更新日志(commit message): <strong>'.$commit_msg.'</strong></p>';
                    echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">作者(Author): <strong>'.$git_author.'</strong></p>';
                    echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">当前版本哈希值(current commit hash): <a href="'.$gitweb.'commit/'.$hash.'"><strong>'.$hash.'</strong></a></p>';
                    echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">当前分支(current branch): <a href="'.$gitweb.'tree/'.$branch_name.'"><strong>'.$branch_name.'</strong></a></p>';

                }
            ?>
        </div>
    </body>
</html>

<?php
    // Visitor Recorder
    // Valid Connection Established, Record this
    $webpage = "index.php";
    $addr = $_SERVER['REMOTE_ADDR'];

    $ua = "";
    if(!isset($_SERVER['HTTP_USER_AGENT'])){
        $ua = "N/A";
    }else{
        $ua = $_SERVER['HTTP_USER_AGENT'];
    }

    $user="test";
    $password="test";
    $dsn="mysql:host=localhost; port=3306";
    $pdo=new PDO($GLOBALS['dsn']."; dbname=peoplestats",$GLOBALS['user'], $GLOBALS['password']);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $sql = 'SELECT * FROM `clients` WHERE `address` = "'.$addr.'"';

    $stmt = $pdo->query($sql);
    $row_count = $stmt->rowCount();
    $rows = $stmt->fetchAll();

    if($row_count == 0){
        $sql = "INSERT INTO `clients` (`address`) VALUES ('".$addr."');";
        $pdo->query($sql);
    }

    // Get Client ID
    $sql = 'SELECT * FROM `clients` WHERE `address` = "'.$addr.'"';
    $stmt = $pdo->query($sql);
    $row_count = $stmt->rowCount();
    $rows = $stmt->fetchAll();
    $client_id = $rows[0]['id'];

    if(isset($client_id) and $client_id != NULL){
        $sql = "INSERT INTO `connection_info` (`client_id`, `webpage`, `user_agent`) VALUES ('".$client_id."' , '".$webpage."', '".$ua."');";
        $pdo->query($sql);
    }

?>

<script>

function serverTime(){
        var st = new Date(document.getElementById("serverYMD").innerHTML);
        st = new Date(st.setSeconds(st.getSeconds() + 1));

        document.getElementById("serverYMD").innerHTML = st.getFullYear() + "/" + (st.getMonth()+1) + "/" + st.getDate() + " " + st.getHours() + ":" + st.getMinutes() + ":" + st.getSeconds();
        setTimeout("serverTime()",1000);
}

var language = 0;

function language_switch(){
    // Language Codes: 0 English, 1 Simplified Chinese.
    if(language == 0){
        language = 1;
        document.getElementById("follow").innerHTML="看看我的Github空间";
    }else{
        language = 0;
        document.getElementById("follow").innerHTML="Follow Me on Github";
    }
}

function fun(){
        var date = new Date()
        var y = date.getFullYear();
        var m = date.getMonth()+1;
        var d = date.getDate(); 
        var hh = date.getHours();
        var mm = date.getMinutes();
        var ss = date.getSeconds();
        if(hh <= 6 & hh >= 0){
            if(language == 0){
                var notice = "Good Night, Have a deep rest."
            }else{
                var notice = "夜深了，但新的一天开始啦~ 凌晨时分，快些睡觉吧!"
            }
        }else if(hh > 6 & hh < 11){
            if(language == 0){
                var notice = "Now is morning, keep doing and smile. :)"
            }else{
                var notice = "上午开始啦！抓住大好时光，去做事情吧！"
            }
        }else if(hh >= 11  & hh <= 12){
            if(language == 0){
                var notice = "We are currently at noon. Eat lunch for our own creation :)"
            }else{
                var notice = "午间时分咯~ 注意快些结束事情，准备干饭叭！"
            }
        }else if(hh > 12 & hh <= 18){
            if(language == 0){
                var notice = "We are currently at afternoon, keep doing... Let's Go!"
            }else{
                var notice = "下午开始啦！抓住大好时光，去做事情吧！"
            }
        }else if(hh >= 19 & hh <= 22){
            if(language == 0){
                var notice = "Evening Coming..."
            }else{
                var notice = "晚上了~ 这段时间应该好好安排一下咯~"
            }
        }else if(hh > 22 & hh <= 23){
            if(language == 0){
                var notice = "Good Night, Have a deep rest."
            }else{
                var notice = "夜深了，差不多收拾一下，准备休息吧。"
            }
        }else{
            // A very strange corner case if your time is 25 hours per day :)
            if(language == 0){
                var notice = "Have a nice day."
            }else{
                var notice = "继续加油哦~ :)"
            }
        }

        document.getElementById("ymd").innerHTML = +y+"-"+m+"-"+d+" "+hh+":"+mm+":"+ss+" "+notice+"";
        setTimeout("fun()",1000)
    }

    window.onload = function(){
        setTimeout("fun()",0)
        setTimeout("serverTime()",1000)
    }
</script>


<style>
    .narrator{
        animation-name: narrator_enter; 
        animation-duration:5s;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    @keyframes narrator_enter {
        0%   {margin-top:-50px;}
        100% {margin-top:15px;}
    }

    #logo{
        text-align:left;
    }

    #header {
        
        /* display: inline-block; */
        border-radius: 5px;
        border-width: 5px;
        border: solid;
        border-color: skyblue;
        background-color: antiquewhite;
        text-align: center;
        display:inline-block;
        margin-left: 25%;
        /* margin-right: 50%; */
        
    }

    .header_button {
        margin: 20px, 20px, 20px, 20px;
        border-radius: 10px;
        /* text-align: right; */

        font-size: large;
    }

    .header_button:hover{
        background-color: rgb(36, 200, 221);
    }

    .header_button:active{
        background-color: sandybrown;
    }

    .good{
        text-align: center;    
    }

</style>
