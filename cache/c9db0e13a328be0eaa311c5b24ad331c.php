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
				<h3>搜索结果</h3>
				<hr>
				<p></p>
			</div>
		</div>
		<div class="row mt centered">	
			<div class="col-lg-8 col-lg-offset-2">
					<div class="col-lg-8-1">
						<?php if (empty($res)): ?>
							<div class="col-lg-8-1-1">
								<h1 align="center">无搜索结果</h1>
							</div>
						<?php endif; ?>
						<?php if (!empty($res)): ?>
						<?php foreach ($res as $val): ?>
						<div class="col-lg-8-1-1">
							<h4><a href="
							<?php if (empty($val['uid'])): ?>
							index.php?a=blog01&id=<?php echo $val['id']; ?>
							<?php endif; ?>
							<?php if (!empty($val['uid'])): ?>
								index.php?a=content&sid=<?php echo $val['id']; ?>&cid=<?php echo $val['cid']; ?>
							<?php endif; ?>
							"><?php echo $val['title']; ?></a></h4>
							<p><?php echo $time=date('Y-m-d H:i:s',$val['date']); ?> <span>浏览数</span>：<?php echo $val['hits']; ?> <span>评论数</span>：<?php echo $val['replycount']; ?></p>
						</div>
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
