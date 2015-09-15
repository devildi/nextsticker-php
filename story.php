<?php
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The 36th story</title>
<link type="text/css" rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.8.3.min.js"/></script>
<script type="text/javascript" src="js/script.js"/></script>
<script type="text/javascript">
window.onload=function(){
	var AjaxState = true;
	var page = 0;
	var pagesize = 5;
	ajaxRequest();
	$(window).on('scroll',function(){  //滑动加载  
		if(checkScrollSlide() && AjaxState){
			AjaxState = false;
			page++;
			ajaxRequest();
			}	
		})
	function ajaxRequest(){
			$.ajax({
				type:'GET',
				url:'ST.php',
				data:'page='+page+'&pagesize='+pagesize,
				datatype:'json',
				beforeSend:function(){
					
					},
				success:function(data){
						var obj= $.parseJSON(data);
						var storymain=document.getElementById('story-main');
						$.each(obj,function(key,value){
						var container=$('<div>').addClass('container').appendTo($(storymain));
						var user=$('<div>').addClass('user').appendTo($(container));
						$('<img>').attr('src',$(value).attr('AVATAR')).appendTo($(user));
						var content=$('<div>').addClass('content').appendTo($(container));
						$('<div>').addClass('triangle').appendTo($(content));
						$('<div style="font-size:24px;font-weight:bold;">').html($(value).attr('COUNTRY')).addClass('story-one').appendTo($(content));
						$('<div style="font-size:20px;font-weight:bold;">').html($(value).attr('TITLE')).addClass('story-two').appendTo($(content));
						if(($(value).attr('PATH'))!=''){
							var storythree= $('<div>').addClass('story-three').appendTo($(content));
							$('<img>').attr('src',$(value).attr('PATH')).appendTo($(storythree));
						}				
						$('<div style="height:20px;">').addClass('story-five').appendTo($(content));
						$('<div>').addClass('story-four').html($(value).attr('CONTENT')).appendTo($(content));
						$('<div style="height:20px;">').addClass('story-five').appendTo($(content));
						})
					},
				complete:function(){
					AjaxState = true;
					}
				})
			}
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
	}
function checkScrollSlide(){
	var $lastBox=$('#story-main>div').last();
	var lastBoxDis=$lastBox.offset().top+Math.floor($lastBox.outerHeight()/2);
	var scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
	var documentH=$(window).height();
	return (lastBoxDis<scrollTop+documentH)?true:false;
	}
</script>
</head>

<body>
    <div id="sidebar" class="side">
      <div class="search" id="search-form">
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
        <li id="Story" class="item"><a href="javascript:;">Story</a></li>
        <li id="World" class="item"><a href="world.php">World</a></li>
        <li id="Style" class="item"><a href="style.php">Guide</a></li>
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
    <a href="javascript:;" id="btn" title="回到顶部" ></a>
       <div id="story-main">
           <div class="country-part"></div>
           <div class="story-ex" style="font-size:25px">Travelers need a home for their stories</div> 
       </div> 
    </div>
</body>
</html>
