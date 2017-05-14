<?php
require('conn.php');
try{
    $pdo=new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
}



header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With");
header('Content-type:text/html;charset=utf-8');

$base64_image_content = $_POST['imgBase64'];
$caseid =isset($_POST['caseid'])?$_POST['caseid']:'';

//匹配出图片的格式
if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
    $type = $result[2];
    $filename = time().".{$type}";
    $new_file = "upload/".$filename;
    // echo $new_file;
    if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
        //echo '新文件保存成功：', $new_file;

        $fileuuid = createGuid();
        $url = "http://www.wmaizhu.com/zmjapi/upload/".$filename;
        $sql="insert into bd_case_photo (zpid ,caseid ,filename ) VALUES('$fileuuid','$caseid','$url')";
        $res=$pdo->exec($sql);

        $out['info'] = '1';
        $out['filename'] = $url;
        $out['caseid'] = $caseid;
        $out['uuid'] = $fileuuid;
        
        echo json_encode($out, JSON_HEX_TAG);
    }else{
        $out['info'] = '2';
        echo json_encode($out, JSON_HEX_TAG);
    }
}




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
