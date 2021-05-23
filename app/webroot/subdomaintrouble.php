<?php
$url=explode(".",str_replace("www.","",$_SERVER['HTTP_HOST']));
$subdomain=$url[0];
$file = '../tmp/wsd.txt';
$main_content = file_get_contents($file);
$main_content=str_replace("exams",$subdomain,$main_content);
$file1 = '../Web.config';
file_put_contents($file1,$main_content);
?>