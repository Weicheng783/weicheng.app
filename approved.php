<?php
if(!isset($_REQUEST['ok']) or $_REQUEST['ok'] == null or $_REQUEST['ok'] == ""){
    echo "<script>alert('ok字段没有填写.'); location.href='index.php';</script>";
    die;
}

// We update the pdo to allow us login the specified database
$pdo = new pdo('mysql:host=localhost; port=3306; dbname=usertable', 'manager', 'awc020826');
$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$sql = 'SELECT * FROM `request` WHERE `email` = "'.htmlspecialchars($_REQUEST['email']).'" AND `password` = "'.htmlspecialchars($_REQUEST['password']).'";';
$re = $pdo->query($sql);

$rows = $re->fetchAll();
if($rows == null){
    $sql = 'DELETE FROM `request` WHERE `email` = "'.htmlspecialchars($_REQUEST['email']).'";';
    $re = $pdo->query($sql);
    echo '<p class="narrator" style="font-size: medium; text-align: center; ">service not available.</p>';
    die;
}

if($_REQUEST['ok'] != "yes"){
    $pdo = new pdo('mysql:host=localhost; port=3306; dbname=usertable', 'manager', 'awc020826');
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $pdo->query("DELETE FROM request WHERE email='".$_REQUEST['email']."' AND password='".$_REQUEST['password']."';");

    $strstr = "echo \"你的注册请求被拒绝(驳回)了哦❌。 用户名：".$_REQUEST['name'].", 邮箱号为：".$_REQUEST['email']."。驳回理由是：".$_REQUEST['cause']."。 <weicheng.app注册通知>\" | mail -s \"weicheng.app注册请求被驳回\" ".$_REQUEST['email']."";
    $result_str = shell_exec($strstr);

    echo "<script>alert('Approval 已成功拒绝❌.'); location.href='index.php'</script>";
}else{
    function create_user(
        $name,
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
        $special_chars = '!@$%^&*+=-/"#';
        $special_int_1 = random_int(0,12);
        $special_int_2 = random_int(0,12);
        $special_int_3 = random_int(0,12);
        $special_int_4 = random_int(0,12);
        $final = $special_chars[$special_int_3].$special_chars[$special_int_1].$str.$special_chars[$special_int_4].$special_chars[$special_int_2];

        // create a user file propose
        $myfile = fopen("/home/stuff/newuser.txt", "w") or die("Unable to open file during creating a new mail user!");
        $namee = $name."\n";
        fwrite($myfile, "create\n");
        fwrite($myfile, $namee);
        fwrite($myfile, $final);
        fclose($myfile);

        return $final;
    }


    $mail_pwd = create_user($_REQUEST['name'],12);

    $pdo = new pdo('mysql:host=localhost; port=3306; dbname=usertable', 'manager', 'awc020826');
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $pdo->query("DELETE FROM request WHERE email='".$_REQUEST['email']."' AND password='".$_REQUEST['password']."';");
    $pdo->query("INSERT INTO `user` (`name`, `email`, `password`, `note`) VALUES ('".$_REQUEST['name']."', '".$_REQUEST['email']."', '".$_REQUEST['password']."', '".$_REQUEST['note']."')");
    
    $strstr = "echo \"你的注册请求已成功✅！未来希望有你相伴，加油！请使用下列这些信息登录。 用户名：".$_REQUEST['name'].", 邮箱号为：".$_REQUEST['email'].", 自动生成的12位数登录密码为： ".$_REQUEST['password']." 。 登录主页面为 https://weicheng.app/ 。你的收件邮箱登录密码是：".$mail_pwd.", 邮箱登录网站是: https://weicheng.app/webmail . 欢迎加入👏 <weicheng.app注册通知>\" | mail -s \"weicheng.app用户注册成功\" ".$_REQUEST['email']."";
    $result_str = shell_exec($strstr);
    $result_str_r = shell_exec("sudo useradd -m -p $(openssl passwd -1 ".$mail_pwd.") ".$_REQUEST['name']);

    echo "<script>alert('Approval 已成功通过✅.'); location.href='index.php'</script>";
}
?>