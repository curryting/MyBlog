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

      <style type="text/css">
        .navbar-nav li a{
          color:#fff;
        }
        .navbar-nav li a:hover{
          color:#1abc9c;
        }
        .search{
          position: absolute;
          top:131px;
          right:140px;
          z-index: 10000;
        }
        .search input[type=text]{
          border:1px solid #fff;
          background: #fff;
          border-radius: 3px;
          height: 25px;
          padding-left: 5px;
        }
        .search input[type=submit]{
          border:1px solid #ccc;
          border-radius: 3px;
          height: 25px;
    
        }
      </style>
	  
	  <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
	  
	</head>
	<body>
	<div style="width:100%">
		<!-- Static navbar -->
    <div class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php if (empty($_SESSION['username'])): ?>
            <a class="navbar-brand" href="index.php?a=login">登录</a>
            <a class="navbar-brand" href="index.php?a=register">注册</a>
          <?php endif; ?>
          <?php if (!empty($_SESSION['username'])): ?>
            <a class="navbar-brand" href="index.php?a=photo" title="个人资料" style="color: #D2691E;font-size: 24px;"><?php echo $username; ?></a>
            <?php if ($isblogger==1): ?>
              <a class="navbar-brand" href="index.php?a=publish">发表博客</a>
              <a class="navbar-brand" href="index.php?a=admin_index&i=0">后台管理</a>
            <?php endif; ?>
             <a class="navbar-brand" href="index.php" style="font-size: 14px;color: #ccc;">首页</a>
             <a class="navbar-brand" href="index.php?c=user&a=delete_session" style="font-size: 14px;color: #ccc;">退出</a>
          <?php endif; ?>
		  <div class="search">
			  <form action="index.php?a=search" method="post">
				<input type="text" name="search" placeholder="请输入关键字" />
				<input type="submit" name="" value="搜索" class="search-1"/>
			  </form>
			</div>
			
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php?a=share" style="font-size: 20px;">技术分享</a></li>
            <li><a href="index.php?a=blog" style="font-size: 20px;">个人日志</a></li>
            <li><a href="index.php?a=file&i=0" style="font-size: 20px;">归档</a></li>
            <li><a href="index.php?a=about" style="font-size: 20px;">关于</a></li>
            <li><a href="index.php?a=message" style="font-size: 20px;">留言</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>

    </div>


    
	</div>
	</body>
</html>