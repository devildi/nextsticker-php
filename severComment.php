<?php 
	require_once('connect.php');
	$COMMENT = isset($_GET['COMMENT'])?$_GET['COMMENT']:'';
	$COMMENTA = isset($_GET['COMMENTA'])?$_GET['COMMENTA']:'';
	$ID = isset($_GET['ID'])?$_GET['ID']:'';
	global $z;
	$sql = "select pic.COMMENT from pic where pic.src = '$ID'";
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while($row = mysql_fetch_assoc($query)){
			$data1[] = $row;
		}
	}
$a = blank(explode(",",$data1[0][COMMENT].$COMMENT));
	$sql = "select pic.COMMENTA from pic where pic.src = '$ID'";
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while($row = mysql_fetch_assoc($query)){
			$data2[] = $row;
		}
	}
$b = blank(explode(",",$data2[0][COMMENTA].$COMMENTA ));

	$fruit = array_combine($b, $a);  

	$data1_1 = $data1[0][COMMENT].$COMMENT.",";
	$data2_2 = $data2[0][COMMENTA].$COMMENTA.",";
	$sql = "update pic SET pic.COMMENTA = '$data2_2',pic.COMMENT = '$data1_1' WHERE pic.src = '$ID'";
	$query = mysql_query($sql);


	echo json_encode($fruit);//返回数据到客户端
	function blank($str){
		foreach($str as $value){
			if($value ==''){
			} else{
				$z[]=$value;
			}
		}
		return $z;
	}


?>