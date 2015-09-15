<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>One site,One world</title>
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
	
	var cities =getByClass('city-intro');
	for (var i=0;i<cities.length;i++){
		cities[i].onclick=function(){
		var $this = $(this);
		var city = $this.attr('id');
		$.ajax({
			type:'GET',
			url:'search.php',
			data:'searchCity='+city,
			datatype:'String',
		})
		location.href = 'searchCity.php';
		

		   // var body=document.getElementsByTagName('body');
		   // $(body).css({'overflow-y':'hidden',});
	    //    var oMask1 = document.createElement("div");
		   // oMask1.id="mask-city";
		   // document.body.appendChild(oMask1);
		   // var main = $('<div>').attr('id','main').appendTo($(oMask1));
		   // $('<a>').attr('id','btn').appendTo($(main));
		   // $('<div>').attr('id','close-city').appendTo($(oMask1));
		   // var $this = $(this);
		   // var city = $this.attr('id');
		   //alert($this.attr('id')+'.php');
		//    waterfallInit1({
		// 			  parent:'main',
		// 			  pin:'box',
		// 			  successFn:success,
		// 			  num:30,
		// 			  requestUrl:'LHASA.php',
		// 			  city:$this.attr('id')
		// 			  });
		//    function success(data){
	 //        	var obj= $.parseJSON(data);
		// 		$.each(obj,function(key,value){
		// 		var oBox=$('<div>').addClass('box').appendTo($('#main'));
		// 		var oPic=$('<div>').addClass('pic').appendTo($(oBox));
		// 		$(oPic)[0].style.height = Math.floor(parseInt($(value).attr('H')))+'px';
		// 		var PHO =document.createElement('img');
		// 		$(PHO).attr('src',$(value).attr('src')).attr('id',$(value).attr('src')).appendTo($(oPic));
					
		// 		var Picture=document.getElementById($(value).attr('src'));
		// 		Picture.onclick=function(){	
		// 		var body=document.getElementById('mask-city');
		// 		$(body).css({'overflow-y':'hidden',});
		// 		var documentH=$(window).height();
		// 		var documentW=$(window).width();
		// 		var oMask = document.createElement("div");
		// 		oMask.id="mask";
		// 		oMask.style.height=documentH+'px';
		// 		oMask.style.width=documentW+'px';
		// 		document.body.appendChild(oMask);
		// 		var Op=document.createElement("div");
		// 		Op.id="picture";
		// 		document.body.appendChild(Op);
		// 		var oImg=$('<img>').attr('src',$(value).attr('src')).appendTo($(Op));
		// 		$('<div>').attr('id','close').appendTo($(Op));
		// 		var W=$(oImg).width();
		// 		Op.style.left=documentW/2-W/2+"px";
		// 		Op.style.top=documentH/2-300+"px";
		// 		var oClose=document.getElementById("close");
		// 		oClose.onclick=function(){
		// 			$(body).css({'overflow-y':'auto',});
		// 			document.body.removeChild(Op);
		// 			document.body.removeChild(oMask);
		// 			};	
		// 			};
					
		// 		var oST=$('<div>').attr('id',$(value).attr('src')+'ST').addClass('something').addClass('icon-heart2').addClass('icon').addClass('love1').appendTo($(oBox));	
		// 		if(($(value).attr('LIKE'))!=''){
		// 			var allUsers = $(value).attr('LIKE');
		// 			var strs = [];
		// 			strs=allUsers.split(",");
		// 			for(var i=0;i<strs.length-1;i++){
		// 				$('<div>').appendTo($(oST)).addClass('user1').text(strs[i]).attr('id',strs[i]);
		// 			}
		// 			$(oST).css({'display':'block',});
					
		// 		}	

		// 		var oCon=$('<ul>').attr('id',$(value).attr('src')).addClass('comment').appendTo($(oBox));//评论框
		// 		if(($(value).attr('COMMENT'))!=''){
		// 			var allCons = $(value).attr('COMMENT');
		// 			var allConsA = $(value).attr('COMMENTA');
		// 			var strscon = [];
		// 			var strsconA = [];
		// 			strscon=allCons.split(",");
		// 			strsconA=allConsA.split(",");
		// 			for(var i=0;i<strsconA.length-1;i++){
		// 				var COMBOX = document.createElement('li');
  //      		    		COMBOX.className = 'commentbox';
  //      		    		COMBOX.innerHTML = '<div class="user1">'+strsconA[i]+'</div>'+
  //                                      '<div class="comContent">'+strscon[i]+'</div>'
  //                   	$(COMBOX).appendTo($(oCon));
		// 			}
		// 			$(oCon).css({'display':'block',});	
		// 		}	

		// 		var oSpan=$('<span>').appendTo($(oPic));
		// 		var oTale=$('<div>Comment</div>').addClass('tale').addClass('icon-comment-stroke').addClass('icon').addClass('CMT').attr('id',$(value).attr('src')).appendTo($(oSpan));

		// 		$(oTale)[0].onclick=function(){	
		// 		if(document.getElementById('sessionHere').innerHTML.replace(/\s/g, "")==''){
		// 				window.location.href="index.php";
		// 		}	else if ( typeof(combox) == "undefined") {
		// 				var combox = document.createElement("div");
		// 				combox.id = "mask-com";
		// 				$(combox).appendTo($(oBox));
		// 				var textbox = $('<textarea>').addClass('textarea').appendTo($(combox));
		// 				$('<button>Comment</button>').addClass('comBtn').attr('id','MACom').appendTo($(combox));
		// 				$('<button>Quit</button>').addClass('comBtn').attr('id','quit').appendTo($(combox)).css({'float':'right',});
		// 				waterfall();
		// 			}
		// 		var quitCombox = document.getElementById('quit');
		// 		quitCombox.onclick=function(){
		// 			$(textbox)[0].parentNode.innerHTML = "";
		// 			combox.parentNode.removeChild(combox);
		// 			waterfall();
		// 		}
		// 		$(textbox)[0].onblur = function () {
  //          		  	var me = this;
  //         		  	var val = me.value;
  //           		if (val == '') {
  //               	timer = setTimeout(function () {
  //                  	$(textbox)[0].parentNode.innerHTML = "";
  //                  	combox.parentNode.removeChild(combox);
		// 			waterfall();
  //               		}, 200);
  //         		  					}
  //      		    						 }
  //      		    var makecomment = document.getElementById('MACom');//发表评论
  //      		    makecomment.onclick = function(){
  //      		    	$.ajax({
  //      		    		type:'GET',
  //      		    		url:'severComment.php',
  //      		    		data:'COMMENT='+$(textbox)[0].value+'&COMMENTA='+document.getElementById('sessionHere').innerHTML+'&ID='+$(value).attr('src'),
		// 				datatype:'json',
		// 				beforeSend:function(){
									
		// 						},
		// 				success:function(){
							
		// 					},
		// 				complete:function(){
								
		// 						}
  //      		    	})
  //      		    	var COMBOX = document.createElement('li');
  //      		    	COMBOX.className = 'commentbox';
  //      		    	COMBOX.innerHTML = '<div class="user1">'+document.getElementById('sessionHere').innerHTML+'</div>'+
  //                                      '<div class="comContent">'+$(textbox)[0].value+'</div>'
  //                   $(COMBOX).appendTo($(oCon));
  //                   oCon.css({'display':'block',});
  //                   $(textbox)[0].value = '';
  //                   $(textbox)[0].parentNode.innerHTML = "";
  //                   combox.parentNode.removeChild(combox);
  //                   startNum = indexReturn($(value).attr('src'));
  //                   waterfall(2);
  //      		    }

		// 		};

		// 		var oLike=$('<div>Liked</div>').addClass('like').attr('id',$(value).attr('src')).addClass('icon').addClass('love').addClass('icon-heart-stroke').appendTo($(oSpan));
		// 	   	$(oLike)[0].onclick=function(){
		// 	   		if(document.getElementById('sessionHere').innerHTML.replace(/\s/g, "")==''){
		// 	   			window.location.href="index.php";
		// 	   		} else{
		// 	   			oLike.addClass("btn-activated");
		// 				setTimeout(function(){
		// 				oLike.removeClass("btn-activated");
		// 					},500);	
		// 				$.ajax({//AJAX动态更新数据库
		// 					type:'GET',
		// 					url:'severLike.php',
		// 					data:'LIKEHERE='+document.getElementById('sessionHere').innerHTML+'&ID='+$(value).attr('src'),
		// 					datatype:'String',
		// 					beforeSend:function(){
								
		// 						},
		// 					success:function(data){
		// 						//alert(data);
		// 						if(data!=''){
		// 							var strs = [];
		// 							strs=data.split(",");
		// 							$(oST)[0].innerHTML='';
		// 							for(var i=0;i<strs.length-1;i++){
		// 								$('<div>').appendTo($(oST)).addClass('user1').text(strs[i]).attr('id',strs[i]);
		// 						   }
		// 						$(oST).css({'display':'block',});		
		// 						}	else{
		// 							$(oST)[0].innerHTML='';
		// 							$(oST).css({'display':'none',});
		// 						}
		// 						startNum = indexReturn($(value).attr('src'));
		// 						waterfall(2);
		// 					},
		// 					complete:function(){
								
		// 						}
		// 				})
		// 	   		}
			   		
		// 		};
		// 		})
		// 		return true;
		// }
		// var oClose1=document.getElementById("close-city");
		//   oClose1.onclick=function(){  
		//          $(body).css({'overflow-y':'auto',});
		// 	     document.body.removeChild(oMask1);
		// 			};	
			}
		}
	}
function checkScrollSlide(){
	var $lastBox=$('#main>div').last();
	var lastBoxDis=$lastBox.offset().top+Math.floor($lastBox.outerHeight()/2);
	var scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
	var documentH=$(window).height();
	return (lastBoxDis<scrollTop+documentH)?true:false;
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
        <li id="World" class="item"><a href="javascript:;">World</a></li>
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
  
                <div class="country-part"></div>    
                   <div id="city-main"> 
                      <ul>
                       <li id ="LHASA" class="city-intro"><img src="images/Lhasa.jpg"><span>LHASA</span></li> 
                       <li id="GREAT BARRIER REEF" class="city-intro"><img src="images/GBR.png"><span>GREAT BARRIER REEF</span></li>   
                       <li id="GREAT OCEAN ROAD" class="city-intro"><img src="images/GOR.jpg"><span>GREAT OCEAN ROAD</span></li>  
                       <li id="KANDY" class="city-intro"><img src="images/Kandy.jpg"><span>KANDY</span></li>
                       <li id="NEGOMBO" class="city-intro"><img src="images/Negombo.jpg"><span>NEGOMBO</span></li>
                       <li id="NUWARAELIYA" class="city-intro"><img src="images/Nuwara Eliya.jpg"><span>NUWARA ELIYA</span></li>
                       <li id="SIGIRIYA" class="city-intro"><img src="images/Sigiriya.jpg"><span>SIGIRIYA</span></li>
                       <li id="GALLE" class="city-intro"><img src="images/Galle.jpg"><span>GALLE</span></li>
                       <li id="MIRISSA" class="city-intro"><img src="images/Mirissa.jpg"><span>MIRISSA</span></li>     
                       <li id="TOKYO" class="city-intro"><img src="images/tokyo.jpg"><span>TOKYO</span></li>
                       <li id="OSAKA" class="city-intro"><img src="images/daban.jpg"><span>OSAKA</span></li>
                       <li id="KAMAKURA" class="city-intro"><img src="images/liancang.png"><span>KAMAKURA</span></li>              
                       <li id="TAIPEI" class="city-intro"><img src="images/taipei.jpg"><span>TAIPEI</span></li>
                       <li id="HUALIEN" class="city-intro"><img src="images/hualien.jpg"><span>HUALIEN</span></li>
                       <li id="CHIUFEN" class="city-intro"><img src="images/jiufen.jpg"><span>CHIUFEN</span></li>
                       <li id="TAMSUI" class="city-intro"><img src="images/danshui.jpg"><span>TAMSUI</span></li>           
                       <li id="DELHI" class="city-intro"><img src="images/Delhi.jpg"><span>DELHI</span></li>
                       <li id="AGRA" class="city-intro"><img src="images/agra.jpg"><span>AGRA</span></li>
                       <li id="VARANASI" class="city-intro"><img src="images/Varanasi.jpg"><span>VARANASI</span></li> 
                       <li id="SYDNEY" class="city-intro"><img src="images/sydney.jpg"><span>SYDNEY</span></li>
                       <li id="BRISBANE" class="city-intro"><img src="images/Brisbane.jpg"><span>BRISBANE</span></li>
                       <li id="MELBOURNE" class="city-intro"><img src="images/Melbourne.jpg"><span>MELBOURNE</span></li>
                       <li id="CAIRNS" class="city-intro"><img src="images/Cairns.jpg"><span>CAIRNS</span></li>
                       <li id="GOLDCOAST" class="city-intro"><img src="images/Goldcoast.jpg"><span>GOLDCOAST</span></li>   
                       <li id="ISTANBUL" class="city-intro"><img src="images/Istanbul.jpg"><span>ISTANBUL</span></li>
                       <li id="ANTALYA" class="city-intro"><img src="images/Antalya.jpg"><span>ANTALYA</span></li>
                       <li id="PAMUKKALE" class="city-intro"><img src="images/Pamukkale.jpg"><span>PAMUKKALE</span></li>
                       <li id="SELCUK" class="city-intro"><img src="images/Selçuk.jpg"><span>SELCUK</span></li>               
                       <li id="AMMAN" class="city-intro"><img src="images/Amman.jpg"><span>AMMAN</span></li>
                       <li id="DEADSEA" class="city-intro"><img src="images/deadsea.jpg"><span>DEADSEA</span></li>
                       <li id="PETRA" class="city-intro"><img src="images/Petra.jpg"><span>PETRA</span></li>
                       <li id="JERASH" class="city-intro"><img src="images/Jerash.jpg"><span>JERASH</span></li>           
                       <li id="KUALALUMPUR" class="city-intro"><img src="images/Kuala Lumpur.jpg"><span>KUALA LUMPUR</span></li>
                       <li id="PENANG" class="city-intro"><img src="images/Penang.jpg"><span>PENANG</span></li>
                       <li id="MALAKA" class="city-intro"><img src="images/Malaka.jpg"><span>MALAKA</span></li>             
                       <li id="BANGKOK" class="city-intro"><img src="images/bangkok.jpg"><span>BANGKOK</span></li>
                       <li id="CHIANGMAI" class="city-intro"><img src="images/changmai.jpg"><span>CHIANGMAI</span></li>
                       <li id="Madaba" class="city-intro"><img src="images/Madaba.jpg"><span>MADABA</span></li>
                     </ul>
                   </div>         
   
</div>
</body>
</html>
