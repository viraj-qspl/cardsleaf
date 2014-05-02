<?php
$file_name = "2.zip";
$file_path = "/var/www/media/cards_image/zip/".$file_name;

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
$content_disposition = "Content-disposition: attachement; filename=\"".$file_name."\"";
header($content_disposition);
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($file_path));
$f = @fopen($file_path,"rb");
while(!feof($f)){
    print(fread($f, 1024*8));
    flush();
}
@fclose($f);
