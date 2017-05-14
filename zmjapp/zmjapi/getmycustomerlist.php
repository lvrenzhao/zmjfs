<?php
require('conn.php');
try{
    $pdo=new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
}



$djr =isset($_GET['djr'])?$_GET['djr']:'';
$data = array();
$sql="select * from bd_case where djr = '$djr' ";
$res=$pdo->query($sql);

foreach($res as $row){
    $data[] = $row;
}
var_json('查询成功',$data);

//---------------------------------functions-------------------------------
function var_json($info = '',$data = array()) {
    $out['data'] = $data ?: array();
    $out['info'] = $info ;
    header('Content-Type: application/json; charset=utf-8');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With");
    echo json_encode($out, JSON_HEX_TAG);
    exit(0);
}