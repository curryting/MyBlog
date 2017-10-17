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

    <style type="text/css">
    	
    	.col-lg-4-1{
    		float: left;
    		margin:0 10px;
    	}
    	.col-lg-4-1 p{
    		margin-top: 5px;
    	}
    	.col-lg-4-1 img{
    		border-radius: 10px;
    	}
    </style>
  </head>

  <body>

    <!-- Static navbar -->
    <?php include "cache/6f573c9cd64b9fdc061b768a273027e4.php" ?>
	
	
	<!-- +++++ Projects Section +++++ -->
	
	<div class="container pt">
		<div class="row mt">
			<div class="col-lg-6 col-lg-offset-3 centered">
				<h3>我的技术分享</h3>
				<hr>
				<p>这里有我在学习技术过程中遇到的一些有趣的问题和技术分享<a href="http://dribbble.com/wanderingbert"></a>.</p>
			</div>
		</div>
		<div class="row mt centered">	
			<?php foreach ($cres as $val): ?>
			<div class="col-lg-4-1">
				<a class="zoom green" href="index.php?a=share_list&cid=<?php echo $val['cid']; ?>"><img src="<?php echo $val['photo']; ?>" alt="" height="251" width="360" /></a>
				<p><?php echo $val['description']; ?><br>
					文章：<?php echo $val['counts']; ?> 篇
				</p>
			</div>
		<?php endforeach; ?>
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
