//从上向下缓冲慢慢出来 ,dom为外面大的box,attr为dom下面的节点，position为数字
			function action(dom,attr,position,timer){
				if(arguments.length>=2){
					this.dom=document.querySelectorAll(dom)[0];  //一定要写[0],不然选到的就是一个集合
					this.timer=timer||1000;
					this.attr=this.dom.querySelectorAll(attr)[0];
					
						var timer=setInterval(function(){
							animate1(this.attr,{top:position});
							
						},this.timer)
					

				}
				
}
			
//计算后的属性				
				function getStyle(el,attr){
					
					if(getComputedStyle){			
						
						
//							var style=getComputedStyle(el,'');
//							style[attr]      style['width']
						
						
						return getComputedStyle(el,'')[attr];  /*获取计算后的属性*/
					}else{
						
						
						return el.currentStyle[attr];
						
					}
					
					
				}
			

function animate1(el,json){		
	
	clearInterval(el.timer);
	el.timer=setInterval(function(){	
		
			var flag=true;
		
		//{height:300,left:100}     width：属性    300：目标点
		//for...in
			for(var attr in json){
				
				//当前的属性值
				var current=parseFloat(getStyle(el,attr));
			
				current=Math.round(current);			
				
				//目标点				
				var target=json[attr];
				//变化量				
				var step=(target-current)/8;						
				
				//向上或者向下取整						
				step=step>0?Math.ceil(step):Math.floor(step);	
				
				
				console.log(attr+'='+current)

				//所有元素都运动完成 在清除定时器				
				if(target!=current){
					flag=false;			
				}
				el.style[attr]=current+step+'px';
			}
			
			
			if(flag){
				
//				console.log('执行结束');
				
				clearInterval(el.timer);				
				return false;
			}
		
									
			
	},30)
	
	
}

window.onload=function(){
	var col=document.getElementsByClassName('col-lg-8');
	var col1=document.getElementsByClassName('col-lg-8-1');
	var col2=document.getElementsByClassName('col-lg-8-1-1');
//	console.log(col2.length);  

	action('.col-lg-8','.col-lg-8-1',0,100);
	

	for(var i=0;i<col2.length;i++){
		col2[i].index=i;
		col2[i].onmouseenter=function(){
			col2[this.index].style.transform='translate(-5px,-5px)';
			col2[this.index].style.boxShadow='5px 5px 5px #ccc';

		}
		
		col2[i].onmouseleave=function(){
			col2[this.index].style.transform='translate(0px,0px)';
			col2[this.index].style.boxShadow='0px 0px 0px #ccc';
		}
	}
	
}
