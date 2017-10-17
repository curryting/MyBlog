<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>STANLEY - Free Bootstrap Theme </title>

    <!-- Bootstrap core CSS -->
    <link href="public/css/bootstrap.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="public/css/main.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="public/js/hover.zoom.js"></script>
    <script src="public/js/hover.zoom.conf.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Static navbar -->
   <?php include "cache/6f573c9cd64b9fdc061b768a273027e4.php" ?>
	
	
	<!-- +++++ Contact Section +++++ -->
	
	<div class="container pt">
		<div class="row mt">
			<div class="col-lg-6 col-lg-offset-3 centered">
				<h3>CONTACT ME</h3>
				<hr>
				<p>请留下您对本博客宝贵的建议或意见</p>
			</div>
		</div>
		<div class="row mt">	
			<div class="col-lg-8 col-lg-offset-2">
				<form role="form" action="index.php?c=message&a=domessage" method="post">
				  <div class="form-group">
				    <h1>留言板</h1>
				  <textarea class="form-control" name='content' rows="6" placeholder="Enter your text here"></textarea>
				    <br>
				  <button type="submit" class="btn btn-success">确认提交</button>
				</form>  

				<hr/ >	
				<!--遍历留言开始-->
				<h5 style="overflow: hidden;">
					<span style="display: block;float: left;">最新留言</span>
					<span style="display: block;float: right;">共有<span style="color: red"><?php echo $mcounts[0]['counts']; ?></span>条记录</span>
				</h5>
					<?php if (!empty($mres)): ?>
					<?php foreach ($mres as $val): ?>
					<div style="width: 100%;border-bottom:1px dashed #ccc;margin-top: 20px;overflow: hidden;">
						<div style="float: left;width: 10%">
						<!--判断该留言的uid是否是一个uniqid生成的id，如果是,则使用默认头像-->
							<img src="<?php echo $val['photo']; ?>" width="60" height="40" style="border-radius: 7px;">
						<!--判断该留言的uid是否是一个uniqid生成的id，如果不是,则找到用户对应的头像-->
						</div>
						<div style="float: left;width: 90%">
							<p style="display:block;float: left;width: 100%">
								<span style="display:block;color: red;float: left;">
								<!--判断该留言的uid是否是一个uniqid生成的id，如果是该用户就是这个id-->
									<?php if (strlen($val['uid'])==13): ?>
										<?php echo $val['uid']; ?><span style="font-size: 12px;color: #ccc;">未登录用户</span>
									<?php endif; ?>
								<!--判断该留言的uid是否是一个uniqid生成的id，如果不是，就找出他对应的用户名-->
									<?php if (strlen($val['uid'])!=13): ?>
									<?php foreach ($ures as $value): ?>
										<?php if ($val['uid']==$value['uid']): ?>
											<?php echo $value['username']; ?>
										<?php endif; ?>
									<?php endforeach; ?>
									<?php endif; ?>
								</span>
								<span style="display:block;color: #ccc;float: right;"><?php echo $time=date('Y月m月d日 H:i:s',$val['date']); ?></span>
							</p>
							<p><?php echo $val['content']; ?></p>
						</div>
					</div>
					<?php endforeach; ?>
					<?php endif; ?> 
					<!--遍历留言结束-->
				<div>
					<a href="index.php?a=message&page=<?php echo $url['first']; ?>" style="font-size: 18px;">首页</a>&nbsp;
					<a href="index.php?a=message&page=<?php echo $url['prev']; ?>" style="font-size: 18px;">上一页</a>&nbsp;
					<a href="index.php?a=message" style="font-size: 18px;"></a>
					<a href="index.php?a=message&page=<?php echo $url['next']; ?>" style="font-size: 18px;">下一页</a>&nbsp;
					<a href="index.php?a=message&page=<?php echo $url['end']; ?>" style="font-size: 18px;">尾页</a>
				</div>
			</div>
		</div><!-- /row -->
	</div><!-- /container -->
	
	
	<!-- +++++ Footer Section +++++ -->
	
	<?php include "cache/bc59cebe8abe9de1e53672022dfc901e.php" ?>
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="public/js/bootstrap.min.js"></script>
  </body>
</html>
