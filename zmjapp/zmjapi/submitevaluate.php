<?php
require('conn.php');
try{
    $pdo=new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
}


$pgid = createGuid();

$pgsjh =isset($_POST['pgsjh'])?$_POST['pgsjh']:'';
//$pgrq =isset($_POST['pgrq'])?$_POST['pgrq']:'';
$xsnd =isset($_POST['xsnd'])?$_POST['xsnd']:'';
$yjfy =isset($_POST['yjfy'])?$_POST['yjfy']:'';
$pgxq =isset($_POST['pgxq'])?$_POST['pgxq']:'';
$pgqy =isset($_POST['pgqy'])?$_POST['pgqy']:'';
$checkitems =isset($_POST['checkitems'])?$_POST['checkitems']:'';

// if(empty($khid)){
// 	$sql="UPDATE BD_CASE SET khch = '$khch',sjh = '$sjh',xqmc = '$xqmc',
// 	xqld = '$xqld' , mph = '$mph', sswz= '$sswz'";
// }else{
$sql="INSERT INTO bd_evaluate (pgid,pgsjh,pgrq,xsnd,yjfy,pgxq,pgqy,checkitems) 
values ('$pgid','$pgsjh',now(),'$xsnd','$yjfy','$pgxq','$pgqy','$checkitems')";
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



function createGuid()
{
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}
