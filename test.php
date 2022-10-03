<?php
$mail_pwd = "&*12345*&";

$result_str_r = shell_exec("sudo useradd -m -p $(openssl passwd -1 ".$mail_pwd.") testb 2>&1");
?>