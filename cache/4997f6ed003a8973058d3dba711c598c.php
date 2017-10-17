<!DOCTYPE html>
<html>
<head>
	<title>注册</title>
	<meta charset="utf-8">
	<style type="text/css">
		body{background-color: #444;}
		*{margin:0 auto;padding:0;}
		.body{width: 400px;height: 300px;text-align: center;margin-top: 150px;}
		p{font-size: 50px;color: #fff;}
		input{width: 390px;height: 50px;margin-top: 20px;font-size: 20px;text-align: 100px;border:1px solid #ccc;border-radius:5px;padding-left: 10px;background-color: #f8f8f8;}
		button{width: 400px;height: 45px;margin-top: 20px;font-size: 20px;background-color: #fff;color: #FF6347;border:1px solid #ccc;border-radius: 3px;}
		.return{display: block;width: 400px;height: 45px;margin-top: 20px;font-size: 20px;background-color: #fff;color: #0cc;border:1px solid #ccc;border-radius: 3px;line-height: 45px;text-decoration: none;}
		span{position: absolute;display: block;line-height: 20px;color:#FF6347;margin-left: 10px;font-size: 14px;}
	</style>
	
	<script type="text/javascript">
		window.onload=function(){
			var body=document.getElementsByClassName('body')[0];
			var inputs=body.getElementsByTagName('input');
			var spans=body.getElementsByTagName('span');
			var zhuce=document.getElementsByClassName('zhuce')[0];
			
			var flag1=false;
			var flag2=false;
			var flag3=false;
			//用户名
			inputs[0].onfocus=function(){
				if(inputs[0].value==''){
					flag1 = false;
					spans[0].innerHTML='请输入用户名';
				}else{
					
					spans[0].innerHTML=' ';
				}
				
			}
			inputs[0].onchange=function(){
				var reg=/^[%&^$#@!*()-+=]{5,13}$/;
				if(this.value.length>=3 && this.value.length<=14){
					if(reg.test(this.value)){
						flag1 = false;
						spans[0].innerHTML='用户名不能有特殊符号';
					}else{
						flag1 =  true;
						spans[0].innerHTML='';
					}
				}else{
					flag1 = false;
					spans[0].innerHTML='用户名小于6位或者大于14位';
				}
			}
			//密码
			inputs[1].onfocus=function(){
				if(inputs[1].value==''){
					flag2 = false;
					spans[1].innerHTML='请输入密码';
				}else{
					
					spans[1].innerHTML=' ';
				}
				
			}
			inputs[1].onchange=function(){
				var reg=/^[a-zA-Z1-9]{6,14}$/;
				if(reg.test(this.value)){
					flag2 = true;
					spans[1].innerHTML=' ';
				}else{
					flag2 = false;
					spans[1].innerHTML='密码必须包含字母和数字';
				}
			}
			//确认密码
			inputs[2].onfocus=function(){
				if(inputs[2].value==''){
					flag3 = false;
					spans[2].innerHTML='请输入密码';
				}else{
				
					spans[2].innerHTML=' ';
				}
				
			}
			inputs[2].onchange=function(){
				var reg=/^[a-zA-Z1-9]{6,14}$/;
				if(reg.test(this.value) && this.value==inputs[1].value){
					flag3 = true;
					spans[2].innerHTML=' ';
				}else{
					flag3 = false;
					spans[2].innerHTML='两次输入的密码不统一';
				}
			}
			
			//点击注册时判断
			// zhuce.onclick=function(){
			// 	if(flag1 && flag2 && flag3){
					
			// 	}else{
			// 		alert("用户名或密码错误");
			// 	}
			// }
		}
	</script>
</head>
<body>
	<div class="body">
		<p>Welcome</p>
		<form action="index.php?c=user&a=doregister" method="post">
			<input type="text" name="username" placeholder="用户名" autofocus><br />
			<span></span>
			<input type="password" name="password" placeholder="密码"> <br />
			<span></span>
			<input type="password" name="repassword" placeholder="再次输入密码"><br />
			<span></span>
			<button class="zhuce">注册</button>
			<a class="return" href="index.php?a=login">返回</a>
		</form>
	</div>
</body>
</html>