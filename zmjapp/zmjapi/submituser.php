<?php
require('conn.php');
try{
    $pdo=new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
}


$yhid =isset($_POST['yhid'])?$_POST['yhid']:'';
$yhxm =isset($_POST['yhxm'])?$_POST['yhxm']:'';
$dlm =isset($_POST['dlm'])?$_POST['dlm']:'';
$dlmm =isset($_POST['dlmm'])?$_POST['dlmm']:'';
$js =isset($_POST['js'])?$_POST['js']:'';

// if(strlen($yhid)>10){
    
    
//     //$sql_update = "UPDATE SD_USER SET YHXM = '$yhxm',dlm='$dlm',dlmm='$dlmm' ,js='$js' WHERE yhid = '$yhid' ";
    

// }else{
    $newyhid = createGuid();
    $sql="INSERT INTO sd_user (yhid,yhxm,dlm,dlmm,js,cjrq)  VALUES ('$newyhid','$yhxm','$dlm','$dlmm','$js',now())" ;
// }

$res=$pdo->exec($sql);



    $out['data'] = $res;
    $out['sql'] = $sql;
    $out['length'] = strlen($yhid);
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