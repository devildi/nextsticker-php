$(window).on('load',function(){
	if(document.getElementById('sessionHere').innerHTML.replace(/\s/g, "")==''){
		var Sess = document.getElementById('sessionHere');
		$(Sess).css({'display':'none',});
	}
	var Sidebar = function(eId,closeBarId){
			this.state = 'opened';
			this.el= document.getElementById(eId||'sidebar');
			this.el1= document.getElementById('top');
			this.el2= document.getElementById('outer');
			//this.el3= document.getElementById('footer');
			this.closeBarEl= document.getElementById(closeBarId||'closeBar');
			var self=this;
			this.closeBarEl.addEventListener('click',function(event){
				if(event.target!==self.el){
					self.triggerSwitch();
					}	
				})
			};
		Sidebar.prototype.open=function(){
			this.el.className='move-right';
			this.el1.className='move-right';
			this.el.style.left = '0';
			this.el1.style.left = '180px';
            this.el2.style.margin = '40px 0 0 180px';
            //this.el3.style.margin = '0 0 0 180px';
			this.state='opened';
			startNum = 0;
			waterfall(2);//瀑布流
			};
		Sidebar.prototype.close=function(){
			this.el.className='move-left';
			this.el1.className='move-left';	
			this.el.style.left = '-180px';
			this.el1.style.left = '0';
			//this.el3.style.left = '0';
			this.el2.style.margin = '40px 0 0 0';
			//this.el3.style.margin = '0 0 0 0';
			this.state='closed';
			startNum = 0;
			waterfall(2);//瀑布流
			};
		Sidebar.prototype.triggerSwitch=function(){
			if(this.state==='opened'){
				this.close();
				}else{
					this.open();
					}
			};
	var sidebar=new Sidebar();
	var obtn=document.getElementById('btn'); //点击事件
	obtn.onclick=function(){
		var timer=setInterval(function(){
		var scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
		var ispeed=Math.floor(-scrollTop/5);
		document.documentElement.scrollTop=document.body.scrollTop=scrollTop+ispeed;
		if (scrollTop==0){
			clearInterval(timer);
			}
			},30)
		}
	$(window).on('scroll',function(){
	var documentH=$(window).height();
		var scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
		if(scrollTop>=documentH){
			obtn.style.display='block';
			}else{
				obtn.style.display='none';
				}	
	})
})
function waterfallInit(json){
	var parent = json.parent;
	var pin= json.pin;
	var successFn = json.successFn;
	var requestNum = json.num;
	var requestUrl = json.requestUrl;
	var city  = json.city;
	var AjaxState = true;
	var page = 0;
	ajaxRequest();//瀑布流
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
				url:requestUrl,
				data:'page='+page+'&requestNum='+requestNum+'&city='+city,
				datatype:'json',
				// beforeSend:function(){
				// 	if(page){
				// 	var $lastBox=$('#main>div').last();
				// 	var lastBoxDis=$lastBox.offset().top+Math.floor($lastBox.outerHeight());
				// 	var loadImg = document.createElement('img');
				// 	loadImg.src="images/preloader.gif";
				// 	loadImg.id = 'loadImg';
				// 	oParent = document.getElementById('main');
				// 	oParent.appendChild(loadImg);
				// 	loadImg.style.position = 'absolute';
				// 	loadImg.style.top  = lastBoxDis-150+'px';
				// 	loadImg.style.left = Math.floor((oParent.offsetWidth-loadImg.offsetWidth)/2)+'px';				
				// }
				// 	},
				success:function(data){
					//alert(data);
						if(successFn(data)){
						waterfall(3);
						};
					},
				complete:function(){

				// 	if(page){
				// 	document.getElementById('main').removeChild(document.getElementById('loadImg'));
				// }
					AjaxState = true;
					}
				})
		}
	}
function waterfallInit1(json){
	var parent = json.parent;
	var pin= json.pin;
	var successFn = json.successFn;
	var requestNum = json.num;
	var requestUrl = json.requestUrl;
	var city  = json.city;
	var AjaxState = true;
	var page = 0;
	startNum = 0;
	ajaxRequest();//瀑布流
	var e =document.getElementById('mask-city');
	$(e).on('scroll',function(){  //滑动加载  
		if(checkScrollSlide() && AjaxState){
			AjaxState = false;
			page++;
			ajaxRequest();
			}	
		})
		function ajaxRequest(){
			$.ajax({
				type:'GET',
				url:requestUrl,
				data:'page='+page+'&requestNum='+requestNum+'&city='+city,
				datatype:'json',
				beforeSend:function(){
					},
				success:function(data){
						if(successFn(data)){
						waterfall(3);
						};
					},
				complete:function(){
					AjaxState = true;
					}
				})
			}
	}

function checkScrollSlide(){
	var $lastBox=$('#main>div').last();
	var lastBoxDis=$lastBox.offset().top+Math.floor($lastBox.outerHeight()/2);
	var scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
	var documentH=$(window).height();
	return (lastBoxDis<scrollTop+documentH)?true:false;
	}
//function callBack(w,h,imgObj){
	//imgObj.style.width=232+'px';
//	var scale = w/232;
//	imgObj.style.height=Math.floor(h/scale)+'px';
//	}
//function loadImg(url,Fn,imgObj){
//	var img= new Image();
//	img.src= url;
//	if(img.complete){
//		Fn(img.width,img.height,imgObj);
//		}else{
//			img.onload=function(){
//				Fn(img.width,img.height,imgObj);
//				img.onload()=null;
//				}
//			}
//	}
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
function waterfall(style){
	var $boxs=$('#main>div');
	var w=$boxs.eq(0).outerWidth();
	var cols=Math.floor($('#outer').width()/w);
	$('#main').width(w*cols).css({
		'margin':'0 auto',
	    });
	var hArr=[];
	//alert(startNum);
	$boxs.each(function(index,value){
		var h=$boxs.eq(index).outerHeight();
		if(index<cols){
			MoveStyle(value,0,index*w,index,style);
			hArr[index]=h;
			}else{
				var minH=Math.min.apply(null,hArr);
				var minHIndex=$.inArray(minH,hArr);
				MoveStyle(value,minH,minHIndex*w,index,style);
				hArr[minHIndex]+=$boxs.eq(index).outerHeight();
				var maxH=Math.max.apply(null,hArr);
                var H = document.getElementById('main');
				H.style.height=(maxH+20)+'px';
				}	
		})
	}
startNum = 0;
function MoveStyle(obj,top,left,index,style){
	if(index <= startNum){
			return ;
		}
	obj.style.position='absolute';
	switch(style){
	  case 1:
		obj.style.top=top+'px';
		obj.style.left=left+'px';
		break;
	  case 2:
	  	$(obj).animate({
		top:top+'px',
		left:left+'px'
		});
		break;
	  case 3:
	  	obj.style.top=top+'px';
		obj.style.left=left+'px';
		obj.style.opacity = 0;
			obj.style.filter = 'alpha(opacity=0)';
			$(obj).stop().animate({
				opacity:1
			},1000);
		break;
	  } 
	  startNum  = index; //更新索引
	}
function indexReturn(id){
	var pics = document.getElementById('main').getElementsByTagName('img');
	for(var i = 0;i<pics.length;i++){
		if($(pics[i]).attr('id') == id){
			return i;
		}
	}
}