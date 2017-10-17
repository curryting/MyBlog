window.onload=function(){
				
				var box=document.getElementById('box');
				// var lis=box.getElementsByTagName('li');
				var a=box.getElementsByTagName('a');
				var bigbox=document.getElementById('bigbox');
				var divs=bigbox.getElementsByTagName('div');
				var header=document.getElementById('header-wrapper');
				

				// var url=window.location.search();
				// alert(url);
				//遍历使得左侧点击切换右侧内容
				/*for(var i=0;i<a.length;i++){
					a[i].index=i;
					a[i].onclick=function(){
						for(var j=0;j<a.length;j++){
							
							a[j].style.background='#eaedf1';
						}
						a[this.index].style.background='#fff';
						
						for(var k=0;k<divs.length;k++){
							
							divs[k].style.display='none';
						}
						
						divs[this.index].style.display='block';
					}
					
				}*/
				
				//监控滚动条，滚动条滚动时左侧和上面不动
				window.onscroll=function(){
					var scrollTop=document.documentElement.scrollTop || document.body.scrollTop;
					if(scrollTop>0){
						header.style.position='fixed';
						header.style.top=0;
						
						
						box.style.height='1000px';
					}
					console.log(scrollTop);
					
				}
				
			}