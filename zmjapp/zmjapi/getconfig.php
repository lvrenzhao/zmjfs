<?php
$type =isset($_GET['type'])?$_GET['type']:'';
$content = file_get_contents("http://www.wmaizhu.com/zmj/config/evaluate/$type.json");
//echo $content;
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With");
echo json_encode($content, JSON_HEX_TAG);
exit(0);