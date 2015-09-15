<?php 
    session_start();
    require_once('connect.php');
    $email = isset($_POST['email'])?$_POST['email']:'';
    $upwd = isset($_POST['upwd'])?$_POST['upwd']:'';
    $ctime = time()+3600;
    $sql = "select nickname from uid where uid.email='$email' and uid.password='$upwd' ";
    $query = mysql_query($sql);
    if($query&&mysql_num_rows($query)){
        while($row = mysql_fetch_assoc($query)){
            $data[] = $row;
        }
    }
    //echo json_encode($data);
    $nickname=$data[0]['nickname'];
    if($data!=null){
        setcookie("nickname",$data['nickname'],$ctime);
        setcookie("login",1,$ctimep);
        $_SESSION['nickname']= $nickname;
        header("location:dis.php");
    }else{
        echo "<script>alert('亲！账号密码不般配喔！');history.go(-1);</script>";
        exit;
    }
?>