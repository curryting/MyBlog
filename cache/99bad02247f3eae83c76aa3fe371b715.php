<!DOCTYPE html>
<html>
<head>
	<title>登录</title>
	<meta charset="utf-8">
	<style type="text/css">
		body{background-color: #444;}
		*{margin:0 auto;padding:0;}
		.body{width: 400px;height: 300px;text-align: center;margin-top: 100px;position: relative;}
		p{font-size: 50px;color: #fff;}
		input{width: 390px;height: 50px;margin-top: 20px;font-size: 20px;text-align: 100px;border:1px solid #ccc;border-radius:5px;padding-left: 10px;background-color: #f8f8f8;}
		button{width: 400px;height: 45px;margin-top: 20px;font-size: 20px;background-color: #fff;color: #FF6347;border:1px solid #ccc;border-radius: 3px;}
		.register{display: block;width: 400px;height: 45px;margin-top: 20px;font-size: 20px;background-color: #fff;color: #FF6347;border:1px solid #ccc;border-radius: 3px;line-height: 45px;text-decoration: none;}
		.fanhui{text-decoration: none;margin:40px 0 0 40px;display: block;font-size: 20px;color:#FFf;}
		.b{position: absolute;right:-1px;bottom:19px;height:50px;display: block;width:100px;border-radius: 5px;font-weight: 100;}
		span{position: absolute;display: block;line-height: 20px;color:#FF6347;margin-left: 10px;font-size: 14px;}
	</style>
	
	<script type="text/javascript">
		window.onload=function(){
			var body=document.getElementsByClassName('body')[0];
			var inputs=body.getElementsByTagName('input');
			var spans=body.getElementsByTagName('span');
			var denglu=document.getElementsByClassName('denglu')[0];
			
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
					spans[0].innerHTML='用户名小于3位或者大于14位';
				}
			}
			//密码
			// inputs[1].onfocus=function(){
			// 	if(inputs[1].value==''){
			// 		flag2 = false;
			// 		spans[1].innerHTML='请输入密码';
			// 	}else{
					
			// 		spans[1].innerHTML=' ';
			// 	}
				
			// }
			
			//验证码
			inputs[2].onfocus=function(){
				if(inputs[2].value==''){
					flag3 = false;
					spans[2].innerHTML='请输入验证码';
				}else{
					
					spans[2].innerHTML=' ';
				}
				
			}
			inputs[2].onchange=function(){
				var reg=/^[a-zA-Z1-9]{4,6}$/;
				if(reg.test(this.value)){
					if(this.value.length>=4 && this.value.length<=6){
						flag3 = true;
						spans[2].innerHTML=' ';
					}else{
						flag3 = false;
						spans[2].innerHTML='验证码不正确';
					}
				}else{
					flag3 = false;
					spans[2].innerHTML='验证码不正确';
				}
			}
			
			// //点击登录时判断
			// denglu.onclick=function(){
			// 	if(flag1 && flag2 && flag3){
					
			// 	}else{
			// 		alert("登录不成功");
			// 	}
			// }
		}
		
	</script>
</head>
<body>
	<a href="index.php" class="fanhui" style="font-weight: bold;">返 回</a>
	<div class="body">
		<p>Welcome</p>
		<form action="index.php?c=user&a=dologin" method="post">
			<input type="text" name="username" placeholder="用户名" autofocus><br />
			<span></span>
			<input type="password" name="password" placeholder="密码" required><br />
			<span></span>
			<input type="text" name="code" placeholder="请输入右图中的验证码"/><br />
			<span></span>
			<b class="b"><img src="index.php?a=code" onclick="this.src=this.src+'&abc='+Math.random();" alt=""></b>
			<button class="denglu">登录</button>
			<a class="register" href="index.php?a=register">注册</a>
		</form>
		
		
	</div>
</body>
</html>