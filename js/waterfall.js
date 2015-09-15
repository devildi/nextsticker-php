function waterfallInit(json){ 
	var parent = json.parent;
	var pin= json.pin;
	var successFn = json.successFn;
	var loadImgSrc = json.loadImgSrc;
	var requestUrl = json.requestUrl;
	var requestNum = json.requestNum;
	ajaxRequest();
	var ajaxState = true
	var page = 0;
	window.onscroll=function(){
		if(checkScrollSite() && ajaxState){
			page++;
			ajaxState = false;
			ajaxRequest();
		}
	}
	function ajaxRequest(){
		$.ajax({
			type:'GET',
			url:requestUrl,
			data:'page='+page+'&requestNum='+requestNum,
			dataType:'json',
			beforeSend:function(){
				if(page){
					var oParent  =document.getElementById(parent);
					var aPin = getClassObj(oParent,pin);
					var lastPinH = aPin[aPin.length-1].offsetTop+aPin[aPin.length-1].offsetHeight;
					var loadImg = document.createElement('img');
					loadImg.src=loadImgSrc;
					loadImg.id = 'loadImg';
					oParent.appendChild(loadImg);
					loadImg.style.position = 'absolute';
					loadImg.style.top  = lastPinH+50+'px';
					loadImg.style.left = Math.floor((oParent.offsetWidth-loadImg.offsetWidth)/2)+'px';
				}
			},
			success:function(data){
				if(successFn(data)){	
				    	alert(11);
					waterfall(parent,pin);
				};
			},
			complete:function(){
				//if(page){
				//	document.getElementById(parent).removeChild(document.getElementById('loadImg'));
				//}
				ajaxState = true;
			}
		})
	}
	
	/***
	 * 校验滚动条位置
	 * @returns  布尔
	 */
	function checkScrollSlide(){
	var $lastBox=$('#main>div').last();
	var lastBoxDis=$lastBox.offset().top+Math.floor($lastBox.outerHeight()/2);
	var scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
	var documentH=$(window).height();
	return (lastBoxDis<scrollTop+documentH)?true:false;
	}
	/***
	 * 
	 * @returns  number
	 */
	function getLastH(){
		var oParent  =document.getElementById(parent);
		var aPin = getClassObj(oParent,pin);
		var lastPinH = aPin[aPin.length-1].offsetTop+Math.floor(aPin[aPin.length-1].offsetHeight/2);
		return lastPinH;
	}
}

function waterfall(parent,pin){
	var $boxs=$('#main>div');
	var w=$boxs.eq(0).outerWidth();
	var cols=Math.floor($('#outer').width()/w);
	$(parent).width(w*cols);
	var hArr=[];
	$boxs.each(function(index,value){
		var h=$boxs.eq(index).outerHeight();
		if(index<cols){
			hArr[index]=h;
			}else{
				var minH=Math.min.apply(null,hArr);
				var minHIndex=$.inArray(minH,hArr);
				MoveStyle(value,minH,minHIndex*w,index);
				hArr[minHIndex]+=$boxs.eq(index).outerHeight();
				}	
		})
	}
var startNum = 0;
function MoveStyle(obj,top,left,index){
	obj.style.position='absolute';
	obj.style.top=top+'px';
	obj.style.left=left+'px';
	}
