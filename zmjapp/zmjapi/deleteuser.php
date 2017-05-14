<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With");

require('conn.php');
try{
    $pdo=new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
}


$userid =isset($_GET['userid'])?$_GET['userid']:'';
$sql="delete from sd_user where yhid='$userid'";
$res=$pdo->exec($sql);


$out['data'] = $res;
$out['info'] = '操作成功' ;
echo json_encode($out, JSON_HEX_TAG);
exit(0);