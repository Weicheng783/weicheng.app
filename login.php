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


    // power of the second security pass
    $pdo1=new PDO($GLOBALS['dsn']."; dbname=usertable",$GLOBALS['user'], $GLOBALS['password']);
    $pdo1 -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $sql1 = 'SELECT * FROM `user` WHERE `name` = "'.$_REQUEST['name'].'";';

    $stmt1 = $pdo1->query($sql1);
    $row_count1 = $stmt1->rowCount();
    $rows1 = $stmt1->fetchAll();


    if($row_count == 0 and $row_count1 == 0){
        echo "<script>alert('登录失败, 查无此人.'); location.href='index.php'</script>";
    }else if($row_count == 0 and $row_count1 != 0){
        // wrong password case
        if($rows1[0]['status'] == ""){
            $status = 1;
        }else{
            $status = $rows1[0]['status'] + 1;
        }

        if($status >= 6){
            $sql1 = 'UPDATE `user` SET `status` = "'.$status.'" WHERE `user`.`name` = "'.$_REQUEST['name'].'";';
            $pdo1->query($sql1);
            echo "<script>alert('登录失败, 用户因输入密码错误次数过多而被锁定，需要重置密码.'); location.href='index.php'</script>";
        }else{
            $sql1 = 'UPDATE `user` SET `status` = "'.$status.'" WHERE `user`.`name` = "'.$_REQUEST['name'].'";';
            $pdo1->query($sql1);
            echo "<script>alert('登录失败, 密码错误, 你已经输错了 ".$status." 次密码，如果密码连续输错5次，用户会被锁定.'); location.href='index.php'</script>";
        }
    }else{
        if($status >= 6){
            echo "<script>alert('登录失败, 用户因输入密码错误次数过多而被锁定，需要重置密码.'); location.href='index.php'</script>";
        }else{
            $sql1 = 'UPDATE `user` SET `status` = "0" WHERE `user`.`name` = "'.$_REQUEST['name'].'";';
            $pdo1->query($sql1);

            setcookie("name","");
            setcookie("name", $rows[0]['name'], 2147483647);

            setcookie("password","");
            setcookie("password", $rows[0]['password'], 2147483647);

            setcookie("email","");
            setcookie("email", $rows[0]['email'], 2147483647);

            echo "<script>alert('登录成功！欢迎你，".$rows[0]['name']."'); location.href='index.php'</script>";
        }
    }
?>