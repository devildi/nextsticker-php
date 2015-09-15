<?php 
    session_start();
    require_once('connect.php');
    $email = isset($_POST['email'])?$_POST['email']:'';
    $upwd = isset($_POST['upwd'])?$_POST['upwd']:'';
    $nickname = isset($_POST['nickname'])?$_POST['nickname']:'';

    $sql = "select ID from uid where uid.email='$email'";
    $query = mysql_query($sql);
    if($query&&mysql_num_rows($query)){
        while($row = mysql_fetch_assoc($query)){
            $data[] = $row;
        }
    }
    if($data!=null){
        echo "<script>alert('亲！邮箱已被注册啦！');history.go(-1);</script>";
        exit;
    }

    $sql = "select ID from uid where uid.nickname='$nickname'";
    $query = mysql_query($sql);
    if($query&&mysql_num_rows($query)){
        while($row = mysql_fetch_assoc($query)){
            $data[] = $row;
        }
    }
    if($data!=null){
        echo "<script>alert('亲！昵称已被用啦！');history.go(-1);</script>";
        exit;
    }
    

    $sql = "insert into uid (email,nickname,password) values ('$email','$nickname','$upwd')";
    $query = mysql_query($sql);
    if($query){
        setcookie("nickname",$nickname);
        setcookie("login",1);
        $_SESSION['nickname']= $nickname;
        header("location:dis.php");
    }
?>