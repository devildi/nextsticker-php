<?php 
	require_once('connect.php');
	$page = isset($_GET['page'])?(int)$_GET['page']:0;
    $pagesize = isset($_GET['pagesize'])?(int)$_GET['pagesize']:5;
	$start=$page*$pagesize; 
	$sql = "select * from tale order by ID desc limit $start,$pagesize ";
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while($row = mysql_fetch_assoc($query)){
			$data[] = $row;
		}
	}
	echo json_encode($data);
?>