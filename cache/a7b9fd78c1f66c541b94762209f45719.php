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
    <link href="public/css/file.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="public/js/hover.zoom.js"></script>
    <script src="public/js/hover.zoom.conf.js"></script>
     <script src="public/js/file.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Static navbar -->
    <?php include "cache/6f573c9cd64b9fdc061b768a273027e4.php" ?>
	
	
	<!-- +++++ Projects Section +++++ -->
	
	<div class="container pt">
		<div class="row mt">
			<div class="col-lg-6 col-lg-offset-3 centered">
				<h3>PROJECT NAME</h3>
				<hr>
				
			</div>
		</div>


		<div class="row mt centered">	
			<div class="col-lg-8 col-lg-offset-2">

					<div class="col-lg-8-1">
						<!--导航开始-->
						<div style="font-size: 24px;margin-bottom: 20px;min-height: 30px;border-radius: 0;">
							<a href="index.php?a=file&i=0" style="color:#D2691E;">展示全部</a>
							<?php if (!empty($cres)): ?>
								<?php foreach ($cres as $val): ?>
								&nbsp;&nbsp;&nbsp; <a href="index.php?a=file&i=<?php echo $val['cid']; ?>" style="color:#D2691E;"><?php echo $val['category_name']; ?></a>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<!--导航结束-->
						<?php if ($i==0): ?>
						<b style="color: #444;">个人日志</b>
						<?php endif; ?>		
						<?php if (!empty($ares)): ?>
						<?php foreach ($ares as $val): ?>				
						<div class="col-lg-8-1-1">
							<h4><a href="index.php?a=blog01&id=<?php echo $val['id']; ?>"><?php echo $val['title']; ?></a></h4>
							<p><?php echo $time=date('Y-m-d H:i:s',$val['date']); ?> <span>浏览数</span>：<?php echo $val['hits']; ?> <span>评论数</span>：<?php echo $val['replycount']; ?></p>
						</div>
						<?php endforeach; ?>
						<?php endif; ?>

						<!--遍历分类和文章-->
						<?php if (!empty($cres)): ?>
						<?php foreach ($cres as $val): ?>
							<b style="color: #444;">
								<?php if ($i==0): ?>
								<?php echo $val['category_name']; ?>
								<?php endif; ?>
							</b>
							<?php foreach ($sres as $value): ?>
							<!--当cid相等的时候才遍历-->
							 <?php if ($val['cid']==$value['cid']): ?>
									
								<?php if (!empty($sres) ): ?>			
							<div class="col-lg-8-1-1">
								<h4><a href="index.php?a=content&sid=<?php echo $value['id']; ?>&cid=<?php echo $val['cid']; ?>"><?php echo $value['title']; ?></a></h4>
								<p><?php echo $time=date('Y-m-d H:i:s',$value['date']); ?> <span>浏览数</span>：<?php echo $value['hits']; ?> <span>评论数</span>：<?php echo $value['replycount']; ?></p>
							</div>
							  <?php endif; ?>
							<?php endif; ?>
							<?php endforeach; ?>
						<?php endforeach; ?>
						<?php endif; ?>
					</div>
			
				<p><bt>Client: <a href="#">BlackTie.co</a></bt> - <bt>Type: <a href="#">Illustration</a></bt> - <bt>Date: <a href="#">January 2014</a></bt></p>
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
