<?php 
	require_once('connect.php');
	$page = isset($_GET['page'])?(int)$_GET['page']:0;
    $num = isset($_GET['requestNum'])?(int)$_GET['requestNum']:5;
	$city = isset($_GET['city'])?$_GET['city']:'SYDNEY';
	$startNum  =$page*$num;
	$sql = "select * from pic,pich where pic.ID=pich.ID and pic.CITY='$city' limit $startNum,$num";
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while($row = mysql_fetch_assoc($query)){
			$data[] = $row;
		}
	}

	$sql = "select * from tale where tale.CITY='$city' order by ID desc limit $startNum,$num";
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while($row = mysql_fetch_assoc($query)){
			$data[] = $row;
		}
	}
	echo json_encode($data);
?>