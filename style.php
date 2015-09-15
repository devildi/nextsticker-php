<?php
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>One city,One tale</title>
<link type="text/css" rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.8.3.min.js"/></script>
<script type="text/javascript" src="js/script.js"/></script>
<script type="text/javascript">
window.onload=function(){

$('#search_query').bind('keyup',function(){
    var searchtext = $('#search_query').val();
    var SEARCHTEXT = searchtext.toUpperCase();
    $.ajax({
        type:'GET',
        url:'search.php',
        data:'SEARCHTEXT='+SEARCHTEXT,
        datatype:'json',
        beforeSend:function(){
          
          },
        success:function(data){
          if (SEARCHTEXT == '') {
            $('#search-suggest').hide();
            };
          var obj= $.parseJSON(data);
          var html='';
          $.each(obj,function(key,value){
            html+='<li>'+value.CITY+'</li>';
            })
          $('#search-result').html(html);
          $('#search-suggest').show();
          },
        complete:function(){
          
          }
        })    
  });
  $(document).bind('click',function(){
    $('#search-suggest').hide();
  });
  var S = document.getElementById('search-result');
  $(S).delegate('li','click',function(){
    var keywords = $(this).text().toUpperCase();
    //alert(keywords);
    $.ajax({
      type:'GET',
      url:'search.php',
      data:'searchCity='+keywords,
      datatype:'String',
    })
    location.href = 'searchCity.php';
  });

    var topic = document.getElementsByTagName('span');
    for(var i =0;i<topic.length;i++){
          topic[i].alpha = 0;
          topic[i].onmouseover=function(){
            startMove(this,40);
          }
          topic[i].onmouseout=function(){
            startMove(this,0);
          }
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
   <div id="sidebar" class="side">
    <div class="search">
        <input tabindex="1" type="text" name="q" id="search_query" placeholder="Search NextSticker" value="" class="search_key" autocomplete="off" required="required">
        <input type="submit" id="search_query_submit" class="search_query_submit" value="">
    </div>
    <div class="suggest" id="search-suggest">
        <ul id="search-result">
        </ul>
    </div>
    <div class="bar">
        <ul class="sidemenu">
        <li id="Discovery" class="item"><a href="dis.php">Discovery</a></li>
        <li id="Story" class="item"><a href="story.php">Story</a></li>
        <li id="World" class="item"><a href="world.php">World</a></li>
        <li id="Style" class="item"><a href="javascript:;">Guide</a></li>
        </ul>
    </div>
    </div>
   <div id="top">
            <div class="left">
              <div id="closeBar" class="select_btn"></div>
            </div>
      <a href="index.html" class="margin_t_5">NextSticker</a>
       <ul class="topbtn" >
        <li id="sessionHere"><?PHP echo $_SESSION['nickname'] ?></li>
      </ul>   
   </div>
   <div id="outer">
    <div class="country-part"></div>
    <div id="style-main">

        <div class="style-content">
           <div class="style-style"><img src="style/istanbul.jpg"><a href="city/Istanbul.php" target="_blank"><span class="style-cover"></span></a></div> 
           <div class="style-style"><img src="style/tokyo.jpg"><span class="style-cover"></span></div>
           <div class="style-style"><img src="style/india.jpg"><span class="style-cover"></span></div>
        </div>

        <div class="style-content">
           <div class="style-style"><img src="style/australia.jpg"><span class="style-cover"></span></div> 
           <div class="style-style"><img src="style/taibei.jpg"><span class="style-cover"></span></div>
           <div class="style-style"><img src="style/vm.jpg"><span class="style-cover"></span></div>
        </div>

    </div>
   </div>
</body>
</html>
