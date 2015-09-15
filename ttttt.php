<?PHP
 set_time_limit(0);//解决超时问题
 require_once('connect.php');
 static $dir_list =0;
 static $file_list =0;
 static $files=array();
 static $files1=array();
 static $data1=array();
 static $data2=array();
 static $data3=array();
 static $data4=array();
 function listfile($dir){
 global $dir_list,$file_list,$files,$files1,$data1,$data2;
 $d = dir($dir);
 while ( $entry = $d->read()) {
 $tem_curnt=$dir."/".$entry;
 $smalltem_curnt="smallworld/Small".$entry;
 //echo  $tem_curnt."<br>";
 if($entry=="." || $entry=="..") continue;
 if ( is_dir( $tem_curnt)) {
 listfile($tem_curnt);
 //echo "文件夹 ".$tem_curnt."<br>";
 //$dir_list++;
 }
 elseif ( is_file($tem_curnt))
 {
 //echo $tem_curnt."<br>";
 $im = new imagick($tem_curnt);
 $im->thumbnailImage( 232, 0);
 $im->writeImage($smalltem_curnt);
 $im->thumbnailImage( 0, 600);
 $im->writeImage($tem_curnt);
 $arr = getimagesize($smalltem_curnt);
 $h= $arr[1];
 $files[] =$tem_curnt;
 //echo $smalltem_curnt."<br>";
 $files1[] =$smalltem_curnt;
 //$data1[] ='src';
 $data1[] =$h;
 //$file_list++;
 }
 }
 $d->close();
 }

listfile("world");
 //foreach ($files as $k => $r) 
//{
//     $data2[] = array($data1[$k]=>$files[$k]);
//}
//echo json_encode($data2);
//foreach ($files as $value)
//{
//echo $value."<br>";
//$query = "INSERT  INTO  pic(src) value('$value')";
//mysql_query($query);
//}
//foreach ($data1 as $value)
//{
//echo $value."<br>";
//$query = "INSERT  INTO  pich(H) value('$value')";
//mysql_query($query);
//}
foreach($files as $k=>$v){
  $query="insert into picc (src,srcs,H,TOTAL) values ('$v','$files1[$k]','$data1[$k]','0')";
  mysql_query($query);
}
?>