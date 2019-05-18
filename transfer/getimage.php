<?php

// write code to get secure image file

$file = DIR_FILE.'image/simplework.png';
header("Content-Type: image/png");
header("Content-Length: " . filesize($file));
header("Content-Disposition: attachment; filename=\"filename.jpg\"");
header('Cache-Control: private');
header('Pragma: private');
$fp = fopen($file,"rb");
fpassthru($fp);
echo $fp;
fclose($fp);
exit();
