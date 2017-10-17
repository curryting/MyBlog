<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <link rel="stylesheet" href="public/editor/css/editormd.preview.css" />

    <title>STANLEY - Free Bootstrap Theme </title>

    <!-- Bootstrap core CSS -->
    <link href="public/css/bootstrap.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="public/css/main.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script src="public/editor/js/jquery.min.js"></script>
	<script src="public/editor/lib/marked.min.js"></script>
	<script src="public/editor/lib/prettify.min.js"></script>
	<script src="public/editor/lib/raphael.min.js"></script>
	<script src="public/editor/lib/underscore.min.js"></script>
	<script src="public/editor/lib/sequence-diagram.min.js"></script>
	<script src="public/editor/lib/flowchart.min.js"></script>
	<script src="public/editor/lib/jquery.flowchart.min.js"></script>
	<script src="public/editor/editormd.js"></script>
	<script type="text/javascript">
	    $(function() {
	        var testEditormdView;
	        testEditormdView = editormd.markdownToHTML("markdown", {
	            htmlDecode      : "style,script,iframe",
	            emoji           : true,
	            taskList        : true,
	            tex             : true,  // 默认不解析
	            flowChart       : true,  // 默认不解析
	            sequenceDiagram : true,  // 默认不解析
	        });
	    });
	</script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!-- Static navbar -->
   <?php include "cache/6f573c9cd64b9fdc061b768a273027e4.php" ?>

	<!-- +++++ Posts Lists +++++ -->
	<!-- +++++ First Post +++++ -->
	
	<?php if (!empty($sres)): ?>
	<?php foreach ($sres as $val): ?>
	<div id="grey">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<p><img src="public/img/user.png" width="50px" height="50px"> <ba>Forever</ba></p>
					<p>
						<bd><?php echo $time=date('Y-m-d H:i:m',$val['date']); ?></bd>
						&nbsp;&nbsp;浏览：<span style="color: red;"><?php echo $val['hits']; ?></span> 评论：<span style="color: red;"><?php echo $val['replycount']; ?></span>
						&nbsp;&nbsp;&nbsp;&nbsp;标签：<?php echo $val['tag']; ?>
					</p>
					<h4>
						<span><?php echo $val['title']; ?></span>
					</h4>
					<p>
						<!--<b>标签:<?php echo $val['tag']; ?></b> -->
					
						<?php echo $val['description']; ?>
					</p>
					<p><a href="index.php?a=content&sid=<?php echo $val['id']; ?>&cid=<?php echo $cid; ?>">查看更多...</a></p>
				</div>

			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /grey -->
	<?php endforeach; ?>
	<?php endif; ?>
	<!-- +++++ Second Post +++++ -->
	<div id="white">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<p><img src="public/img/user.png" width="50px" height="50px"> <ba>Stanley Stinson</ba></p>
					<p><bd>January 3, 2014</bd></p>
					<h4>An Image Post</h4>
					<p><img class="img-responsive" src="public/img/blog01.jpg" width="100px" height="100px"></p>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					<p><a href="index.php?a=blog01">Continue Reading...</a></p>
				</div>

			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /white -->
	
	<!-- +++++ Third Post +++++ -->
	
	
	<!-- +++++ Footer Section +++++ -->
	
	<?php include "cache/bc59cebe8abe9de1e53672022dfc901e.php" ?>
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="public/js/bootstrap.min.js"></script>
  </body>
</html>
