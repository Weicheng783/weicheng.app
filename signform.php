<html>
    <head>
        <link rel="icon" type="image/x-icon" href="./favicon.ico" />
        <link rel="stylesheet" href="mystyle.css">
        <script src="myscript.js"></script>
        <meta charset="utf-8">
        <title>Weicheng Space Recovery</title>
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
                echo '<button class="header_button" onclick="location.href=\'signup.php\';">返回信息录入页面</button>';
            ?>

            <?php
                function random_str(
                    $length,
                    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
                ) {
                    $str = '';
                    $max = mb_strlen($keyspace, '8bit') - 1;
                    if ($max < 1) {
                        throw new Exception('$keyspace must be at least two characters long');
                    }
                    for ($i = 0; $i < $length; ++$i) {
                        $str .= $keyspace[random_int(0, $max)];
                    }
                    return $str;
                }

                echo '<p class="narrator" style="font-size: medium; text-align: center; ">正在连接数据库</p>';

                try{
                    $pdo = new pdo('mysql:host=localhost; port=3306', 'manager', 'awc020826');
                    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

                    $sql = "CREATE DATABASE IF NOT EXISTS usertable";
                    $pdo->query($sql);

                }catch(PDOException $e){}

                try{
                    // We update the pdo to allow us login the specified database
                    $pdo = new pdo('mysql:host=localhost; port=3306; dbname=usertable', 'manager', 'awc020826');
                    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

                    $sql = "
                    CREATE TABLE IF NOT EXISTS `user` ( 
                        `id` INT NOT NULL AUTO_INCREMENT , 
                        `name` TEXT NOT NULL , 
                        `email` TEXT NOT NULL , 
                        `password` TEXT NOT NULL , 
                        `note` TEXT NULL , 
                        `status` TEXT NULL , 
                        `timeadded` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
                        PRIMARY KEY (`id`)
                    );
                    
                    CREATE TABLE IF NOT EXISTS `request` ( 
                        `id` INT NOT NULL AUTO_INCREMENT , 
                        `name` TEXT NOT NULL , 
                        `email` TEXT NOT NULL , 
                        `password` TEXT NOT NULL , 
                        `note` TEXT NULL , 
                        `datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
                        `ip` TEXT NULL ,
                        PRIMARY KEY (`id`)
                    );";

                    $pdo->query($sql);

                    echo "<h3 style='text-align:center; color:green;'>数据库连接正常</h3>";
                    echo '<p class="narrator" style="font-size: medium; text-align: center; ">信息录入流程开始，正在检查用户名是否存在</p>';

                    $re = $pdo->query("SELECT * FROM user WHERE name='".$_COOKIE['name']."';");
                    $rows = $re->fetchAll();
                    if($rows == null){
                        echo '<p class="narrator" style="font-size: medium; text-align: center; ">用户不存在，准备发送申请请求</p>';
                        // $re = $pdo->query("SELECT * FROM request WHERE ip=".$_SERVER['REMOTE_ADDR'].";");
                        // $row_count = $stmt->rowCount();

                        // if($row_count >= 5){
                        //     echo '<p class="narrator" style="font-size: medium; text-align: center; ">❌请求数量过多，请明天再试。</p>';
                        // }else{
                            // $row_count = $row_count + 1;
                            // echo '<p class="narrator" style="font-size: medium; text-align: center; ">这是今日第 '.$row_count.' 次请求, 共5次。</p>';

                            // SENDING LOGIC
                            $pwd = random_str(12);
                            $strstr = "echo \"TA正在尝试注册用户名：".$_REQUEST['name'].", 邮箱号为：".$_REQUEST['email'].", 想和你说的话是：".$_REQUEST['note'].", 密码生成为：".$pwd." , 验证链接为：https://weicheng.app/approval.php?email=".$_REQUEST['email']."&password=".$pwd."   <weicheng.app注册请求审核系统>\" | mail -s \"weicheng.app注册请求审核\" weicheng.ao@student.manchester.ac.uk";
                            $result_str = shell_exec($strstr);

                            $pdo->query("INSERT INTO `request` (`name`, `email`, `password`, `ip`, `note`) VALUES ('".$_REQUEST['name']."', '".$_REQUEST['email']."', '".$pwd."', '".$_SERVER['REMOTE_ADDR']."', '".$_REQUEST['note']."')");
                            echo '<p class="narrator" style="font-size: medium; text-align: center; ">✅请求已发出，请等待管理员检查，时常检查垃圾邮箱的收信情况，你现在可以退出了。</p>';

                        // }

                    }else{
                        echo '<p class="narrator" style="font-size: medium; text-align: center; ">用户存在，正在检查邮箱号与已知记录是否一致</p>';

                        if($_REQUEST['email'] === $rows[0]['email']){
                            echo '<p class="narrator" style="font-size: medium; text-align: center; ">用户名、邮箱号与已知记录一致</p>';
                            // $re = $pdo->query("SELECT * FROM request WHERE name='".$_SERVER['name']."';");
                            // $row_count = $stmt->rowCount();

                            // if($row_count >= 5){
                            //     echo '<p class="narrator" style="font-size: medium; text-align: center; ">❌请求数量过多，请明天再试。</p>';
                            // }else{
                            //     $row_count = $row_count + 1;
                            //     echo '<p class="narrator" style="font-size: medium; text-align: center; ">这是今日第 '.$row_count.' 次请求, 共5次。</p>';
    
                                // SENDING LOGIC
                                $genpwd = random_str(12);
                                // $strstr = "echo \"TA正在尝试更改用户名：".$_REQUEST['name'].", 邮箱号为：".$_REQUEST['email'].", 想和你说的话是：".$_REQUEST['note'].", TA的新密码是：".$genpwd." <weicheng.app注册请求审核系统>\" | mail -s \"weicheng.app用户管理系统\" weicheng.ao@student.manchester.ac.uk";
                                $strstr = "echo \"你正在尝试更改用户名：".$_REQUEST['name'].", 邮箱号为：".$_REQUEST['email'].", 想和管理员说的话是：".$_REQUEST['note'].", 你的新密码是：".$genpwd." <weicheng.app用户端邮件已送达>\" | mail -s \"weicheng.app用户端邮件\" ".$_COOKIE['email']."";
                                $result_str = shell_exec($strstr);
    
                                $pdo->query("UPDATE `user` SET `password`='".$genpwd."' WHERE `name`='".$_REQUEST['name']."';");
                                echo '<p class="narrator" style="font-size: medium; text-align: center; ">✅成功！你的密码理论上已经更改，新密码已发至你的邮箱，注意查收，时常检查垃圾邮箱的收信情况，你现在可以退出了。</p>';
    // UPDATE `alternations` SET `time`='".date('Y/m/d H:i:s', time())."' WHERE `diary_id` = ".$id.";
                            // }

                        }else{
                            echo '<p class="narrator" style="font-size: medium; text-align: center; color: red;">❌用户名、邮箱号与已知记录不一致，你是不是输错了什么字符？请返回重试。</p>'; 
                        }
                    }
                }
                catch(PDOException $e){
                    echo "<h3 style='text-align:center; color:red;'>❌数据库无法连接，可能正在维护，请稍晚些时候再试.</h3>";
                }
            ?>
        </div>
    </body>
</html>