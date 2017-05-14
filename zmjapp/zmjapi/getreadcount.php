<?php
require('conn.php');
try{
    $pdo=new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
}


$articleid =isset($_GET['articleid'])?$_GET['articleid']:'';


$sql="select readcount from bd_article_readcount where articleid =  '$articleid' ";
$res=$pdo->query($sql);
foreach($res as $row){
 $readcount = $row['readcount'];
}

    $out['data'] = $readcount;
    $out['info'] = '查询成功' ;
    header('Content-Type: application/json; charset=utf-8');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With");
    echo json_encode($out, JSON_HEX_TAG);
    exit(0);