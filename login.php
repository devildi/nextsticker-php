<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login-NextSticker</title>
<link type="text/css" rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.8.3.min.js"/></script>
<script type="text/javascript">
window.onload = function(){
    var formSubmit=document.getElementById('login_form_submit');
              formSubmit.alpha=100;
              formSubmit.onmouseover=function(){
                startMove(formSubmit,80);
               }
               formSubmit.onmouseout=function(){
                startMove(formSubmit,100);
               }
}
function startMove(obj,iTarget){
    clearInterval(obj.timer);
    obj.timer=setInterval(function(){
        var speed = 0;
        if (obj.alpha > iTarget) {
            speed = -10;
        }else{
            speed = 10;
        }
        if (obj.alpha == iTarget) {
            clearInterval(obj.timer);
        }else{
            obj.alpha+=speed;
            obj.style.filter = 'alpha(opacity:'+obj.alpha+')';
            obj.style.opacity = obj.alpha/100;
        }
    },30)
}
</script>
</head>
<body>
    <div id="Layer1" style="position:absolute; width:100%; height:100%; z-index:-1">
        <img src="images/login.jpg" height="100%" width="100%"/>    
    </div>
    <div id="wel_top1">
        <div id="login"><a href="sign.php" style="color:#000">邮箱注册</a></div>
    </div>
    <div id="wel_top2"><h2>NextSticker</h2></div>
    <div id="wel_top4"><p>Hey! Nice to meet you!</p></div>
    <div >
        <div class="stand"></div>
        <form id="sign_form" method="post" action="loginback.php">
            <div class="form_row form_row_email">
               
                <input type="email" name="email" placeholder="邮箱" id="signup_email" data-required="required">
            </div>
            <div class="form_row form_row_password login_psw">
                
                <input type="password" name="upwd" placeholder="密码" id="signup_password" data-required="required">
            </div>
            <div class="stand"></div>
            <input id="login_form_submit" type="submit" value="登陆"/>
        </form>
    </div>
</body>
</html>
