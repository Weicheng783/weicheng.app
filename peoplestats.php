<?php 
    echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">';

    $addr = $_SERVER['REMOTE_ADDR'];
    // if($addr == "")

    // Data Base Preparatory Work
    $user="test";
    $password="test";
    $dsn="mysql:host=localhost; port=3306";

    $pdo=new PDO($GLOBALS['dsn'],$GLOBALS['user'], $GLOBALS['password']);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    try{
        $sql = "CREATE DATABASE IF NOT EXISTS peoplestats";
        echo "<h3 style='text-align:center; color:orange;'>Database Connecting.</h3>";

        $pdo->query($sql);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        echo "<h3 style='text-align:center; color:green;'>Database Connected. Server Time is UTC +0.</h3>";

        // We update the pdo to allow us login the specified database
        $pdo=new PDO($GLOBALS['dsn']."; dbname=peoplestats",$GLOBALS['user'], $GLOBALS['password']);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        $sql = "

        CREATE TABLE IF NOT EXISTS `clients` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `address` TEXT NOT NULL , 
            `note` TEXT NULL , 
            `status` TEXT NULL , 
            `firsttime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
            PRIMARY KEY (`id`)
        );

        CREATE TABLE IF NOT EXISTS `connection_info` ( 
            `id` INT NOT NULL AUTO_INCREMENT ,
            `client_id` INT NOT NULL , 
            `datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
            `note` TEXT NULL , 
            `webpage` TEXT NOT NULL , 
            `user_agent` TEXT NULL , 
            PRIMARY KEY (`id`) ,
            FOREIGN KEY (`client_id`) REFERENCES `clients`(`id`)
        );

        ";
        $pdo->query($sql);


        $sql = 'SELECT * FROM `clients` ORDER BY `firsttime` DESC';

        $stmt = $pdo->query($sql);
        $row_count = $stmt->rowCount();
        $rows = $stmt->fetchAll();

        if($row_count == 0){
            echo '<p class="narrator" style="font-size: x-large; text-align: center;">目前还没有人访问网站的任何网页。</p>';
        }else{
            for($i = 0; $i < $row_count; $i++){
                echo '<p class="narrator" style="font-size: large; text-align: center; color: purple;"> ID: ' . $rows[$i]['id'] . " Address: " . $rows[$i]['address'] . " NOTE: " . $rows[$i]['note'] . " Status: " . $rows[$i]['status'] . " First Visit Time: " . $rows[$i]['firsttime'] . "</p>";
            }
        }

        echo "<hr />";

        $sql = 'SELECT * FROM `connection_info` ORDER BY `datetime` DESC';

        $stmt = $pdo->query($sql);
        $row_count = $stmt->rowCount();
        $rows = $stmt->fetchAll();

        if($row_count == 0){
            echo '<p class="narrator" style="font-size: x-large; text-align: center;">目前还没有人访问网站的任何网页。</p>';
        }else{
            for($i = 0; $i < $row_count; $i++){
                echo '<p class="narrator" style="font-size: large; text-align: center; color: purple;"> ID: ' . $rows[$i]['id'] . " Client ID: " . $rows[$i]['client_id'] . " Connected Time: " . $rows[$i]['datetime'] . " Which Page: " . $rows[$i]['webpage'] . " Note: " . $rows[$i]['note'] . "</p>";
            }
        }

        echo "<hr />";

    }catch(PDOException $e){
        echo "<h3 style='text-align:center; color:red;'>Database Disconnected.</h3>";
        echo "<script>alert('此时无法连接数据库，如果问题一直存在，是代码或mysql服务出了问题.');</script>";
    }

?>



<style>
    img:focus {
        outline: 5px solid orange;
        border-radius: 5px;
    }

    #map {
        position: relative; 
        top: 0; 
        right: 0; 
        bottom: 0; 
        left: 0;
        border-radius: 5px;
        border-width: 5px;
        border: solid;
        border-color: skyblue;
        background-color: antiquewhite;
        text-align: center;
        display:inline-block;
        margin-left: 25%;
    }

    .narrator{
        /* animation-name: narrator_enter; 
        animation-duration:5s; */
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    .table_font{
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-size: 20px;
    }

    .input_font{
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-size: 25px;
        text-align: center;
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