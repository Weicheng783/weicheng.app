<?php
    $result_str = shell_exec("echo \"This is the body\" | mail -s \"this is the subject\" weicheng.ao@student.manchester.ac.uk 2>&1");
    echo $result_str;
?>