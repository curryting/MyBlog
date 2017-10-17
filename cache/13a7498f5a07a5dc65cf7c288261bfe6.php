<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <style type='text/css'>
        .liubo span{font-size: 16px;font-weight: bold;}
        .liubo input[type=text]{width: 300px;height: 30px;border-radius: 5px;border:1px solid #ccc;}
        .liubo input[type=number]{width: 100px;height: 30px;border-radius: 5px;border:1px solid #ccc;}
        .liubo input[type=submit]{width: 100px;height: 25px;border-radius: 5px;border:1px solid #ccc;}
        .liubo input[type=file]{width: 300px;height: 25px;border-radius: 5px;}
    </style>

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
	
	
	<!-- +++++ Projects Section +++++ -->
	
	<div class="container pt">
		<div class="row mt">
			<div class="col-lg-6 col-lg-offset-3 centered">
				<h3>个人资料</h3>
				<hr>
				<p></p>
			</div>
		</div>
		<div class="row mt centered">	
			<div class="col-lg-8 col-lg-offset-2">
				<form action="" method="post">
            <table width="800" border="1" class="liubo">
              <tr height='40'>
                <td width="100" align="right"><span>用户名:</span></td>
                <td width="200" align="left">
                  <input type="text" name="username" />
                </td>
              </tr>
              <tr height='40'>
                <td align="right"><span>年龄:</span></td>
                <td align="left">
                  <input type="number" name="age" />
                </td>
              </tr>
              <tr height='100'>
                <td align="right"><span>我的头像:</span></td>
                <td align="left">
                  <img src="" alt="">
                </td>
              </tr>
              <tr height='40'>
                <td></td>
                <td align="left">
                  <input type="file" name="photo" />
                </td>
              </tr>
              <tr height='40'>
                <td></td>
                <td align="left">
                  <input type="submit" value="修改">
                </td>
              </tr>
            </table>   
        </form>
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
