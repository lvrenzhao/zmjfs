<?php
require('conn.php');
try{
    $pdo=new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
}


$khid =isset($_POST['khid'])?$_POST['khid']:'';
$khch =isset($_POST['khch'])?$_POST['khch']:'';
$sjh =isset($_POST['sjh'])?$_POST['sjh']:'';
$xqmc =isset($_POST['xqmc'])?$_POST['xqmc']:'';
$xqld =isset($_POST['xqld'])?$_POST['xqld']:'';
$mph =isset($_POST['mph'])?$_POST['mph']:'';
$sswz =isset($_POST['sswz'])?$_POST['sswz']:'';
$djr =isset($_POST['djr'])?$_POST['djr']:'';
//$djsj =isset($_POST['djsj'])?$_POST['djsj']:'';
$checkitems =isset($_POST['checkitems'])?$_POST['checkitems']:'';
$bz =isset($_POST['bz'])?$_POST['bz']:'';

// if(empty($khid)){
// 	$sql="UPDATE BD_CASE SET khch = '$khch',sjh = '$sjh',xqmc = '$xqmc',
// 	xqld = '$xqld' , mph = '$mph', sswz= '$sswz'";
// }else{
$sql="INSERT INTO bd_case (khid,khch,sjh,xqmc,xqld,mph,sswz,djr,djsj,checkitems,bz) VALUES ('$khid', '$khch', '$sjh', '$xqmc', '$xqld', '$mph', '$sswz', '$djr', now(), '$checkitems','$bz')";
// }



$res=$pdo->exec($sql);

    $out['data'] = $res;
    $out['info'] = '操作成功' ;
    header('Content-Type: application/json; charset=utf-8');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With");
    echo json_encode($out, JSON_HEX_TAG);
    exit(0);



