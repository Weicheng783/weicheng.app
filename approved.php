<?php
if(!isset($_REQUEST['ok']) or $_REQUEST['ok'] == null or $_REQUEST['ok'] == ""){
    echo "<script>alert('ok字段没有填写.'); location.href='index.php';</script>";
    die;
}

if($_REQUEST['ok'] != "yes"){
    $pdo = new pdo('mysql:host=localhost; port=3306; dbname=usertable', 'manager', 'awc020826');
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $pdo->$query("DELETE FROM request WHERE name='".$_REQUEST['email']."' AND password='".$_REQUEST['password']."';");

    $strstr = "echo \"你的注册请求被拒绝(驳回)了哦❌。 用户名：".$_REQUEST['name'].", 邮箱号为：".$_REQUEST['email']."。驳回理由是：".$_REQUEST['cause']."。 <weicheng.app注册通知>\" | mail -s \"weicheng.app注册请求被驳回\" ".$_REQUEST['email']."";
    $result_str = shell_exec($strstr);

    echo "<script>alert('Approval 已拒绝❌.'); location.href='index.php'</script>";
}else{
    $pdo = new pdo('mysql:host=localhost; port=3306; dbname=usertable', 'manager', 'awc020826');
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $pdo->$query("DELETE FROM request WHERE name='".$_REQUEST['email']."' AND password='".$_REQUEST['password']."';");
    $pdo->query("INSERT INTO `user` (`name`, `email`, `password`, `note`) VALUES ('".$_REQUEST['name']."', '".$_REQUEST['email']."', '".$_REQUEST['password']."', '".$_REQUEST['note']."')");
    
    $strstr = "echo \"你的注册请求已成功✅！未来希望有你相伴，加油！请使用下列这些信息登录。 用户名：".$_REQUEST['name'].", 邮箱号为：".$_REQUEST['email'].", 自动生成的12位数登录密码为： ".$_REQUEST['password']." 。 登录主页面为 https://weicheng.app/ 欢迎加入👏 <weicheng.app注册通知>\" | mail -s \"weicheng.app用户注册成功\" ".$_REQUEST['email']."";
    $result_str = shell_exec($strstr);

    echo "<script>alert('Approval 已成功通过✅.'); location.href='index.php'</script>";
}
?>