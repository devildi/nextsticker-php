<?php
	require_once('connect.php');
	$LIKEHERE = isset($_GET['LIKEHERE'])?$_GET['LIKEHERE']:'wudi';
	$ID = isset($_GET['ID'])?$_GET['ID']:'world/AA/3.JPG';
	$sql = "select pic.LIKE from pic where pic.src = '$ID'";
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while($row = mysql_fetch_assoc($query)){
			$data[] = $row;
		}
	}
	global $j,$data1,$data2;
 	$a=inOrnot($data,$LIKEHERE);
 	if ($a == 1){
 		$c = explode(",",$data[0][LIKE] );
 		foreach ($c as $value) {
 			if($value == $LIKEHERE){

 			}else{
 				$b[]=$value;
 				$d=implode(",", $b);
 			}
 		}
 	} else{
 		$d = $data[0][LIKE].$LIKEHERE.",";
 	}
 	$e = explode(",",$d );
 	$TOTAL = count($e)-1;
	$sql = "update pic SET pic.LIKE = '$d',pic.TOTAL = '$TOTAL' WHERE pic.src = '$ID'";
	$query = mysql_query($sql);
	echo $d;
	function inOrnot($allUser,$User){
		$a = explode(",",$allUser[0][LIKE] );	
		foreach($a as $value){
			if($value == $User){			
				$j = 1;
				break;
			}else{ $j = 0;}
		}
			return $j;	
}
?>