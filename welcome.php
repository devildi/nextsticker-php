<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to NextSticker!</title>
<link type="text/css" rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.8.3.min.js"/></script>
<script type="text/javascript">
window.onload=function(){
   var QQ=document.getElementById('QQ');
              QQ.alpha=100;
               QQ.onmouseover=function(){
                startMove(QQ,70);
               }
               QQ.onmouseout=function(){
                startMove(QQ,100);
               }
   var weibo=document.getElementById('weibo');
              weibo.alpha=100;
               weibo.onmouseover=function(){
                startMove(weibo,70);
               }
               weibo.onmouseout=function(){
                startMove(weibo,100);
               }
   $(".notice").on("click",function(){
      alert("333");
    })
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
function getByClass(clsName,parent){
  var oParent=parent?document.getElementById(parent):document,
      eles=[],
    elements=oParent.getElementsByTagName('*');  
   for(var i=0,l=elements.length;i<l;i++){
     if(elements[i].className==clsName){
       eles.push(elements[i]);
       }
     }
    return eles;
  }
</script>
</head>
<body>
	  <div id="Layer1" style="position:absolute; width:100%; height:100%; z-index:-1">
        <img src="images/wel.jpg" height="100%" width="100%"/>    
    </div>    
    <div id="wel_top">
        <div id="login"><a href="index.php" style="color:#FFF">邮箱登陆</a></div>
        <div id="sign"><a href="sign.php" style="color:#FFF">邮箱注册</a></div>
    </div>
    <div id="wel_top1"></div>
    <div id="wel_top2"><h2>NextSticker</h2></div>
    <div id="wel_top4"><p>Fancy your trip</p></div>
    <div style="height:25px;"></div>
    <div id="wel_top3">
        <div class="log">
            <div class="stand"></div>
        	  <div id="QQ" class="QQ icon icon-qq">  QQ账号登陆</div>
            <div class="stand"></div>
            <div id="weibo" class="weibo icon icon-weibo">  新浪微博登陆</div>
            <div class="stand"></div>
        </div>
    </div>
    <div id="bot">
        <div id="HaveALook"><a href="dis.php" style="color:#FFF">Have a look </a></div>
        <div id="HaveALook1" class="icon icon-question-circle notice"></div>
    </div>
</body>
</html>
