<html>
    <head>
        <link rel="icon" type="image/x-icon" href="./favicon.ico" />
        <link rel="stylesheet" href="mystyle.css">
        <script src="myscript.js"></script>
        <meta charset="utf-8">
        <title>Weicheng Space Sign-Up</title>
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
            ?>

            <?php
                if(!isset($_COOKIE['name']) or $_COOKIE['name'] == null or $_COOKIE['name'] == ""){
                    echo '<p class="narrator" style="font-size: medium; text-align: center; ">信息录入</p>';
                    echo '<p class="narrator" style="font-size: medium; text-align: center; ">在下面输入昵称(登录用户名)，邮箱号，备注。已注册用户自动发送新密码到邮箱，未注册用户会先发邮件给管理员验证通过后再得到新密码，如果一直没收到，请检查垃圾邮件。</p>';
                    echo '<form action="signform.php" method="post" style="display:center;">
                            <p>登录用户名[必填]: <input name="name" class="input_font"></input></p>
                            <p>邮箱(用于重置密码)/(你的注册邮箱)[必填]: <input name="email" class="input_font"></input></p>
                            <p>要和我说的话/备注[可不填]: <input name="note" class="input_font"></input></p>
                            <p><button type="submit" class="header_button" onclick="">确认请求/确认重置密码</button></p>
                            </form>';
                    echo '<button class="header_button" onclick="location.href=\'index.php\';">回主页面</button>';

                }else{
                    echo '<img src="./logo_2022.png" id="logo" alt="Weicheng_Space_Welcome_Message" style=" text-align: left; border-radius:20px; display:inline-block; height:100px; width:auto;">
                    <img src="./logo.png" id="logo" alt="Weicheng_Space_Welcome_Message" style=" text-align: left; border-radius:20px; display:inline-block; height:100px; width:auto;">';

                    echo '<p class="narrator" style="font-size: medium; text-align: center; "><strong>'.$_COOKIE['name'].'</strong>，你已经登录了，如需得到新密码，请在下方确认信息重置。</p>';
                    echo '<form action="signform.php" method="post" style="display:center;">
                        <p>登录用户名[必填]: <input name="name" class="input_font" value="'.$_COOKIE['name'].'"></input></p>
                        <p>邮箱(用于重置密码)/(你的注册邮箱)[必填]: <input name="email" class="input_font" value="'.$_COOKIE['password'].'"></input></p>
                        <p>要和我说的话/备注[可不填]: <input name="note" class="input_font"></input></p>
                        <p><button type="submit" class="header_button" onclick="">确认请求/确认重置密码</button></p>
                        </form>';
                    echo '<button class="header_button" onclick="location.href=\'index.php\';">回主页面</button>';
                    echo '<button class="header_button" onclick="location.href=\'out.php\';">退出登录</button>';
                }
            ?>
        </div>
    </body>
</html>