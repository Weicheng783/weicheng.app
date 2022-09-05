<html>
    <head>
        <link rel="icon" type="image/x-icon" href="./favicon.ico" />
        <link rel="stylesheet" href="mystyle.css">
        <script src="myscript.js"></script>
        <meta charset="utf-8">
        <title>New User Approval</title>
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

                try{
                    // We update the pdo to allow us login the specified database
                    $pdo = new pdo('mysql:host=localhost; port=3306; dbname=usertable', 'manager', 'awc020826');
                    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

                    $sql = 'SELECT * FROM `request` WHERE `email` = "'.htmlspecialchars($_GET['email']).'" AND `password` = "'.htmlspecialchars($_GET['password']).'";';
                    // $sql = 'SELECT * FROM `user`';
                    // $sql = "SELECT * FROM `user` ;";

                    echo '<p class="narrator" style="font-size: medium; text-align: center; ">'.$sql.'</p>';

                    $re = $pdo->$query($sql);

                    $rows = $re->fetchAll();
                    if($rows == null){
                        echo '<p class="narrator" style="font-size: medium; text-align: center; ">❌查无此信息，不予放行。</p>';
                    }else{
                        echo '<p class="narrator" style="font-size: medium; text-align: center; ">验证下列信息是否可以通过</p>';
                        echo '<form action="approved.php" method="post" style="display:center;">
                            <p>登录用户名: <input name="name" class="input_font" value="'.$rows[0]['name'].'"></input></p>
                            <p>邮箱(用于重置密码): <input name="email" class="input_font" value="'.$rows[0]['email'].'"></input></p>
                            <p>备注: <input name="note" class="input_font" value="'.$rows[0]['note'].'"></input></p>
                            <p>密码明文: <input name="password" class="input_font" value="'.$rows[0]['password'].'"></input></p>
                            <p><button type="submit" class="header_button" onclick="" name="ok" value="yes">✅通过</button></p>
                            <p>驳回理由: <input name="cause" class="input_font" ></input></p>
                            <p><button type="submit" class="header_button" onclick="" name="ok" value="no">❌拒绝请求</button></p>
                            </form>';
                    }
                }catch(PDOException $e){
                    echo '<p class="narrator" style="font-size: medium; text-align: center; ">🔴数据库离线。</p>';
                }
            ?>
        </div>
    </body>
</html>