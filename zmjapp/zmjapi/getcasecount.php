<?php
require('conn.php');
try{
    $pdo=new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
}




$sql="select count(1) total from bd_case ";
$res=$pdo->query($sql);
foreach($res as $row){
 $total = $row['total'];
}

    $out['data'] = $total;
    $out['info'] = '查询成功' ;
    header('Content-Type: application/json; charset=utf-8');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With");
    echo json_encode($out, JSON_HEX_TAG);
    exit(0);