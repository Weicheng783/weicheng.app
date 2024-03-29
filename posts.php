<html>
    <head>
        <link rel="icon" type="image/x-icon" href="./favicon.ico" />
        <meta charset="utf-8">
        <title>Weicheng Space</title>
        <!-- Optimised for mobile users -->
        <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    </head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

    <?php
        // echo "暂不开放，请等待🔐网络安全措施添加进来并测试之后，将再开放。";
        // die;
        
        function createPostWithPhoto($baseName, $num_of_photos){
            echo '<button id="'.$baseName.'_expand" class="header_button">展开/Expand</button>';
            echo '<button id="'.$baseName.'_close" style="display: none;" class="header_button">收缩/Minify</button>';
            echo "<div id='".$baseName."' style='display: none;' class='scroll-container'>";
            for($i = 1; $i < $num_of_photos+1; $i++){
                echo '<img id="'.$baseName.'_'.$i.'" src="./images/'.$baseName.'_'.$i.' Large.jpeg"  alt="photo not found or unreadable" style=" text-align: left; border-radius:20px; display:flex; height:400px; width:auto;">';
                echo '<script>document.getElementById("'.$baseName.'_'.$i.'").addEventListener("dblclick", function(){ if(confirm("你双击点按了这张图片，想看看原图么?") == true){window.location.href = "./images/'.$baseName.'_'.$i.'.jpeg";} } );</script>';
                // echo '<a class="narrator" href="./images/'.$baseName.'_'.$i.'.jpeg" style="font-size: small; text-align: center; border-radius: auto; background-origin: padding-box;">查看/下载这张jpeg原大小图片</a>';
            }
            echo "</div>";

            echo '<script>
            document.getElementById("'.$baseName.'_expand").addEventListener("click", function(){ document.getElementById("'.$baseName.'").style = "display: flex;"; document.getElementById("'.$baseName.'_expand").style="display: none;"; document.getElementById("'.$baseName.'_close").style=""; } );
            </script>';

            echo '<script>
            document.getElementById("'.$baseName.'_close").addEventListener("click", function(){ document.getElementById("'.$baseName.'").style = "display: none;"; document.getElementById("'.$baseName.'_expand").style=";"; document.getElementById("'.$baseName.'_close").style="display: none";} );
            </script>';
        }
    ?>

    <body style="background-color: antiquewhite; text-align:center;">
        <div id='header_group' style="display:block; text-align: center;">
            <!-- <div style="display: inline-flex;"> -->
            <!-- <img src="./logo_2022.png" id="logo" alt="Weicheng_Space_Welcome_Message" style=" text-align: left; border-radius:20px; display:inline-block; height:100px; width:auto;"> -->
            <!-- <img src="./logo.png" id="logo" alt="Weicheng_Space_Welcome_Message" style=" text-align: left; border-radius:20px; display:inline-block; height:100px; width:auto;"> -->
            <!-- <img src="./weicheng_avatar.jpeg" id="logo" alt="Weicheng_Space_Welcome_Message" style=" text-align: left; border-radius:20px; display:inline-block; height:100px; width:auto;"> -->
            <p class="narrator" style="font-size: x-large; text-align: center; " id="ymd"></p>
            <p class="narrator" style="font-size: medium; text-align: center; ">双击照片查看/下载原大小jpeg图</p>
            <button id="follow" class="header_button" onclick="window.location.href='https://weicheng.app'">到主页</button>
        </div>

        <!-- Start Write Blogs -->
        <!-- 01 -->
        <div class="narrator" style="text-align:center; border-style:dashed; border-width:3px; border-radius:5px; width:100%; display:inline-block; padding: 3px; margin-bottom: 20px;">
            <p class="narrator" style="font-size: medium; text-align: center; border-radius: auto; background-origin: padding-box;">2022/08/17 晚</p>
            <p class="narrator" style="font-size: medium; text-align: center; border-radius: auto; background-origin: padding-box;">Tesco的豌豆炒饭加肉😋</p>
            <?php
                createPostWithPhoto("220817", 3);
            ?>
        </div>

        <!-- 00 -->
        <div class="narrator" style="text-align:center; border-style:dashed; border-width:3px; border-radius:5px; width:100%; display:inline-block; padding: 3px; margin-bottom: 20px;">
        <p class="narrator" style="font-size: medium; text-align: center; border-radius: auto; background-origin: padding-box;">2022/08/13 晚</p>
        <p class="narrator" style="font-size: medium; text-align: center; border-radius: auto; background-origin: padding-box;">校园随拍</p>
        <?php
            createPostWithPhoto("220813", 10);
        ?>
        </div>

    </body>
</html>



<?php
    // Visitor Recorder
    // Valid Connection Established, Record this
    $webpage = "posts.php";
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
    }
</script>


<style>
    .narrator{
        /* animation-name: narrator_enter; 
        animation-duration:5s; */
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

    /* HORIZONTAL SCROLL */
    .scroll-container{
        overflow: auto;
        /* white-space: nowrap; */
        /* padding: 5px 70px 5px 20px; */
        background: transparent;
        /* height: 100%; */
        /* border-radius:15px; */
    }
</style>