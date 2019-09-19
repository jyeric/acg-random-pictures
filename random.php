<?php
//读取文本
$str = explode("\n", file_get_contents('pic.txt'));
$k = rand(0,count($str));
$sina_img = str_re($str[$k]);
$size_arr = array('large', 'mw1024', 'mw690', 'bmiddle', 'small', 'thumb180', 'thumbnail', 'square');
$size = !empty($_GET['size']) ? $_GET['size'] : 'large' ;
if(!in_array($size, $size_arr)){
    $size = 'large';
}
$url = 'https://raw.githubusercontent.com/jyeric/acg-pictures/master/1.jpg'.$size.'/'.$sina_img;
//解析结果
$result=array("code"=>"200","imgurl"=>"$url");
 
//Type Choose参数代码
$type=$_GET['return'];
switch ($type)
{   
    
//Json格式解析
case 'json':
$imageInfo = getimagesize($url);  
$result['width']="$imageInfo[0]";  
$result['height']="$imageInfo[1]";  
header('Content-type:text/json');
echo json_encode($result);  
break;
//IMG
default:
header("Location:".$result['imgurl']);
break;
}
function str_re($str){
  $str = str_replace(' ', "", $str);
  $str = str_replace("\n", "", $str);
  $str = str_replace("\t", "", $str);
  $str = str_replace("\r", "", $str);
  return $str;
}
?>
