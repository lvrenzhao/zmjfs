<?php
require('conn.php');
try{
    $pdo=new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
}


$sjh =isset($_GET['sjh'])?$_GET['sjh']:'';
$xqm =isset($_GET['xqm'])?$_GET['xqm']:'';
$djr =isset($_GET['djr'])?$_GET['djr']:'';
//$ksrq =isset($_GET['ksrq'])?$_GET['ksrq']:'';
//$jsrq =isset($_GET['jsrq'])?$_GET['jsrq']:'';
$page =isset($_GET['pagesize'])?$_GET['pagesize']:'';
$djryhid =isset($_GET['djryhid'])?$_GET['djryhid']:'';

$perNumber=5; 
if (!isset($page)) {  
 $page=1;  
} 
$startCount=($page-1)*$perNumber; 

$data = array();

$sql="select * from bd_case where 1=1 ";

if (strlen($djryhid)>0) {  
    $sql = $sql." and djr = '$djryhid' ";
}
if (strlen($sjh)>0) {  
    $sql = $sql." and sjh like '%$sjh%' ";
}
if (strlen($xqm)>0) {  
    $sql = $sql." and xqmc like '%$xqm%' ";
}

$sql = $sql." order by djsj desc Limit $startCount,$perNumber ";

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