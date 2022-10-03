<html>
    <head>
        <link rel="icon" type="image/x-icon" href="./favicon.ico" />
        <link rel="stylesheet" href="mystyle.css">
        <script src="myscript.js"></script>
        <meta charset="utf-8">
        <title>Weicheng Space 2022</title>
        <!-- Optimised for mobile users -->
        <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    </head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

    <body style="background-color: antiquewhite;">
        <div id='header_group' style="display:block; text-align: center;">
            <p class="narrator" style="font-size: x-large; text-align: center; " id="ymd"></p>
            
            <?php
                date_default_timezone_set('Europe/London');
                $current_date = date('Y/m/d H:i:s');
                echo '<p class="narrator" style="font-size: large; text-align: center; ">英国时间: <strong id="serverYMD">'.$current_date.'</strong>.</p>';
                echo '<img src="./logo_2022.png" id="logo" alt="Weicheng_Space_Welcome_Message" style=" text-align: left; border-radius:20px; display:inline-block; height:100px; width:auto;">
                <img src="./logo.png" id="logo" alt="Weicheng_Space_Welcome_Message" style=" text-align: left; border-radius:20px; display:inline-block; height:100px; width:auto;">';
            ?>

            <?php
                if(!isset($_COOKIE['name']) or $_COOKIE['name'] == null or $_COOKIE['name'] == ""){
                    echo '<form action="login.php" method="post" style="display:center;">
                            <p>用户: <input name="name" class="input_font"></input></p>
                            <p>密码: <input type="password" name="password" class="input_font"></input></p>
                            <p><button type="submit" class="header_button" onclick="">进入</button></p>
                            </form>';
                    echo '<button class="header_button" onclick="location.href=\'signup.php\';">重置密码/用户解冻/注册</button>';
                    echo '<p class="narrator" style="font-size: x-large; text-align: center; "><button id="cv" class="header_button" onclick="window.location.href=\'https://weicheng.app/webmail\'">📮收信邮箱登录</button></p>';

                }else{
                    echo '<p class="narrator" style="font-size: medium; text-align: center; "><strong>'.$_COOKIE['name'].'</strong>，你好。</p>';
                    echo '<button class="header_button" onclick="location.href=\'out.php\';">退出登录</button>';
                    echo '<button class="header_button" onclick="location.href=\'signup.php\';">重置密码</button>';
                    echo '<button class="header_button" onclick="location.href=\'https://weicheng.app/webmail\';">📮收信邮箱登录</button>';

                    echo '<p class="narrator" style="font-size: x-large; text-align: center; ">#曼城少年，追光向前🌈</p>';
                    echo '<p class="narrator" style="font-size: x-large; text-align: center; ">#23年英硕进入备战倒计时🌈 All in!</p>';

                    $total_count = shell_exec("git rev-list --all --count 2>&1");
                    echo '<p class="narrator" style="font-size: medium; text-align: center; border-radius: auto; background-origin: padding-box;">总版本迭代号: <strong>#'.$total_count.'</strong></p>';

                    echo '<p><button id="cv" class="header_button" onclick="window.location.href=\'https://weicheng.app/cv.pdf\'">CV / RESUME / 个人简历</button></p>';
                    echo '<p class="narrator" style="font-size: x-large; text-align: center; "><button id="cv" class="header_button" onclick="window.location.href=\'https://weicheng.app/posts.php\'">看看最近的更新和照片🙃</button></p>';
                    echo '<img src="./2223allin.jpeg"  alt="make it possible" style=" text-align: left; border-radius:20px; display:inline-block; height:auto; width:80%;">';


                    // Source Control Information Display
                    // $gitweb = "https://github.com/Weicheng783/weicheng.app/";

                    // $branch_name = shell_exec('git branch --show-current 2>&1');
                    // $hash = shell_exec('git rev-parse --short HEAD 2>&1');
                    // $commit_msg = shell_exec('git log -1 --pretty=format:%B 2>&1');
                    // $last_updated_time = shell_exec('git log -1 --format=%cd 2>&1');
                    // $git_author = shell_exec("git log -1 --pretty=format:'%an (%ae)' 2>&1");

                    // echo '<hr/>';
                    // echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">⚠️Repo currently private. ⚠️本代码仓库暂不对外开放。</p>';

                    // echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">☞ [Source Code Management / 代码管理]</p>';
                    // echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">最近一次更新(last updated time): <strong>'.$last_updated_time.'</strong></p>';
                    // echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">更新日志(commit message): <strong>'.$commit_msg.'</strong></p>';
                    // echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">作者(Author): <strong>'.$git_author.'</strong></p>';
                    // echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">当前版本哈希值(current commit hash): <a href="'.$gitweb.'commit/'.$hash.'"><strong>'.$hash.'</strong></a></p>';
                    // echo '<p class="narrator" style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">当前分支(current branch): <a href="'.$gitweb.'tree/'.$branch_name.'"><strong>'.$branch_name.'</strong></a></p>';

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