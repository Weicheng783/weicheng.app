<?php
    $user="manager";
    $password="awc020826";
    $dsn="mysql:host=localhost; port=3306";
    $pdo=new PDO($GLOBALS['dsn']."; dbname=usertable",$GLOBALS['user'], $GLOBALS['password']);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $sql = 'SELECT * FROM `user` WHERE `name` = "'.$_REQUEST['name'].'" AND `password` = "'.$_REQUEST['password'].'";';

    $stmt = $pdo->query($sql);
    $row_count = $stmt->rowCount();
    $rows = $stmt->fetchAll();

    if($row_count == 0){
        echo "<script>alert('登录失败.'); location.href='index.php'</script>";
    }else{
        setcookie("name","");
        setcookie("name", $rows[0]['name'], 2147483647);

        setcookie("password","");
        setcookie("password", $rows[0]['password'], 2147483647);

        setcookie("email","");
        setcookie("email", $rows[0]['email'], 2147483647);

        echo "<script>alert('登录成功！欢迎你，".$rows[0]['name']."'); location.href='index.php'</script>";
    }
?>