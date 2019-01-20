<?php

$file = 'C:/xampp/securefiles/nature.jpg';
header("Content-Type: image/jpeg");
header("Content-Length: " . filesize($file));
header("Content-Disposition: attachment; filename=\"filename.jpg\"");
header('Cache-Control: private');
header('Pragma: private');
$fp = fopen($file,"rb");
fpassthru($fp);
echo $fp;
fclose($fp);
exit();
