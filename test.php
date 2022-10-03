<?php
$result_str_r = shell_exec("sudo useradd -m -p $(openssl passwd -1 ".$mail_pwd.") ".$_REQUEST['name']);
?>