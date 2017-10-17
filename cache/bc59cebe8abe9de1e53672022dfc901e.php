<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
			 <!-- Bootstrap core CSS -->
	    <link href="public/css/bootstrap.css" rel="stylesheet">
		

	    <!-- Custom styles for this template -->
	    <link href="public/css/main.css" rel="stylesheet">

	    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	    <script src="public/js/hover.zoom.js"></script>
	    <script src="public/js/hover.zoom.conf.js"></script>

     
	</head>
	<body>
		<!-- Static navbar -->
    <div id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h4>我的地址</h4>
          <p>
             地址 987,<br/>
            +34 9054 5455, <br/>
            深圳, 中国.
          </p>
        </div><!-- /col-lg-4 -->
        
        <div class="col-lg-4">
          <h4>友情链接</h4>
          <p>
            <?php if (!empty($lres)): ?>
            <?php foreach ($lres as $val): ?>
              <a href="<?php echo $val['url']; ?>" target="_blank"><?php echo $val['name']; ?></a><br/>
            <?php endforeach; ?>
            <?php endif; ?>
          </p>
        </div><!-- /col-lg-4 -->
        
        <div class="col-lg-4">
          <h4>关于 Curry</h4>
          <p>This cute theme was created to showcase your work in a simple way. Use it wisely.</p>
        </div><!-- /col-lg-4 -->
      
      </div>
    
    </div>
  </div>
	</body>
</html>