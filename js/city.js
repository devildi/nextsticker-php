window.onload = function(){
	var container = document.getElementById('container');
	var list = document.getElementById('list');
	var buttons = document.getElementById('buttons').getElementsByTagName('span');
	var prev = document.getElementById('prev');
    var next = document.getElementById('next');
    var index = 1;
    var animated = false;
    var timer;
//var W = $(document).width();
//alert($(document).width());
//alert($(window).width());
//alert($(document.body).width());
function animate (offset){
	animated = true;
	var newleft = parseInt(list.style.left)+offset;
	var time = 300;
	var interval = 10;
	var speed = offset/(time/interval);
	function go(){
		if((speed > 0 && parseInt(list.style.left) < newleft) || (speed < 0 && parseInt(list.style.left) > newleft)){
			list.style.left=parseInt(list.style.left)+speed+'px';
			setTimeout(go,interval);
		}
		else{
			animated = false;
			list.style.left = newleft+'px';
	   		if(newleft > -1000){
					list.style.left = -4000 +'px';
							}
			if(newleft < -4000){
			list.style.left = -1000 +'px';
					}
		}
	}
	go();
}
    next.onclick = function(){
    	if(index==4){
    		index = 1;
    	}
    	else {index+=1;}
    	//alert(index);
    	showButton();
    	if(!animated){
    		animate(-1000);
    	}
    	
    }
    prev.onclick = function(){
    	if(index == 1){
    		index = 4;
    	} else{
    		index-=1;
    	}
    	showButton();
    	if(!animated){
    		animate(1000);
    	}  	
    }
    for(var i=0;i<buttons.length;i++){
    	buttons[i].onclick=function(){
    		if(this.className=='on'){
    			return;
    		}
    		var myindex = parseInt(this.getAttribute('index'));
    		var offset = -1000 * (myindex-index);
    		index = myindex;
    		showButton();
    		if(!animated){
    			animate(offset);
    		}	
    	}
    }
    function showButton(){
    	for(var i=0;i<buttons.length;i++){
    		if(buttons[i].className='on'){
    			buttons[i].className='';  			
    		}
    	}
		buttons[index-1].className = 'on';
}

function play(){
	timer = setInterval(function(){
		next.onclick();
	},3000)
}
function stop(){
	clearInterval(timer);
}
}
