<?php
require('conn.php');
try{
    $pdo=new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
}


$jobid = createGuid();

$xm =isset($_POST['xm'])?$_POST['xm']:'';

$xb =isset($_POST['xb'])?$_POST['xb']:'';

$sr =isset($_POST['sr'])?$_POST['sr']:'';

$sjh =isset($_POST['sjh'])?$_POST['sjh']:'';

$wxqqh =isset($_POST['wxqqh'])?$_POST['wxqqh']:'';

$jslx =isset($_POST['jslx'])?$_POST['jslx']:'';

$szcs =isset($_POST['szcs'])?$_POST['szcs']:'';

// if(empty($khid)){
// 	$sql="UPDATE BD_CASE SET khch = '$khch',sjh = '$sjh',xqmc = '$xqmc',
// 	xqld = '$xqld' , mph = '$mph', sswz= '$sswz'";
// }else{
$sql="INSERT INTO bd_job (jobid,xm,xb,sr,sjh,wxqqh,jslx,szcs,djsj) 
values ('$jobid','$xm','$xb','$sr','$sjh','$wxqqh','$jslx','$szcs',now())";
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


