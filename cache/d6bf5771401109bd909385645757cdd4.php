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

    <!--引入评论的css样式-->
	<link href="public/css/sty.css" rel="stylesheet">

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

    <style type="text/css">
    	.form{
    		text-align: left;
    		margin-bottom: 10px;
    		margin-top: 10px;
    	}
    	.form input[type=text]{
    		padding-left: 5px;
    		width:400px;
    		border-radius: 5px;
    		border:1px solid #ccc;
    		height:25px;
    	}
    	.form input[type=submit]{
    		border-radius: 5px;
    		border:1px solid #ccc;
    		color:#fff;
    		background: #444;
    	}
    	.p1{
    		min-height: 1px;
    		background: #f2f2f2;
    		margin-top: 5px;
    		color:#999;
    		padding-left: 5px;
    		width:300px;
    		font-size: 12px;
    		border-radius: 5px;
    	}
    	.p1 span{
    		color:#666;
    	}
    </style>
  </head>

  <body>

    <!-- Static navbar -->
    <?php include "cache/6f573c9cd64b9fdc061b768a273027e4.php" ?>

	
	<!-- +++++ Post +++++ -->
	<div id="white">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<p><img src="public/img/user.png" width="50px" height="50px"> <ba>Stephen Curry</ba></p>
					<p>
					<bd><?php echo $time=date('Y-m-d, H:i:s',$res[0]['date']); ?></bd>
						&nbsp;&nbsp;浏览：<span style="color: red;"><?php echo $res[0]['hits']; ?></span>
						&nbsp;&nbsp;&nbsp;&nbsp;标签：<?php echo $res[0]['tag']; ?>
					</p>
					
						<h4><?php echo $res[0]['title']; ?></h4>
						<!--
						<p><img class="img-responsive" src="public/img/blog01.jpg" width="100" height="100"></p>
					-->
					<p>
						<div id="markdown">
						<!--【注1】在textarea里面，显示内容前面不能出现空格，否则显示样式不对-->
						<!--【注2】存放markdown格式的时候，如果有特殊字符，可以使用htmlentities和addcslashs进行转化-->
							<textarea style="display:none;" name="test-editormd-markdown-doc"><?php echo $res[0]['content']; ?>
					        </textarea>
						</div>
					</p>
					<br>
					<p><bt>TAGS: <a href="#"><?php echo $res[0]['tag']; ?></a></bt></p>
						
					<hr>
					<p><a href="index.php?a=blog"> 返回</a></p>

					<!--评论开始-->
						<div id="respond-post-77" class="respond">
					       <div class="comments-content">
					          <!-- Comment Form -->
					          <form method="post" action="index.php?c=comment&a=docomment&id=<?php echo $id; ?>" id="comment-form" class="comment-form" role="form">
					            <h3 id="response">评论</h3>
					                          
					                        <textarea name="content" id="textarea" class="form-control" placeholder="请填写您要评论的内容。" required></textarea>
					            <a id="cancel-comment-reply-link" href="https://longyujin9.com/default/77.html#respond-post-77" rel="nofollow" style="display:none" onclick="return TypechoComment.cancelReply();">取消回复</a>            <button type="submit" id="misubmit">提交</button>
					          </form>
					        </div>
					      </div>
					<!--评论结束-->
					<hr />

					<!--遍历评论开始-->
					<h5 style="overflow: hidden;">
						<span style="display: block;float: left;">最新评论</span>
						<span style="display: block;float: right;">共有<span style="color: red"><?php echo $res[0]['replycount']; ?></span>条记录</span>
					</h5>
					<?php if (!empty($res1)): ?>
					<?php foreach ($res1 as $val): ?>
					<div style="width: 100%;border-bottom:1px dashed #ccc;margin-top: 20px;overflow: hidden;">
					<!--判断该留言的uid是否是一个uniqid生成的id，如果是,则使用默认头像-->
						<div style="float: left;width: 10%">
							<img src="<?php echo $val['photo']; ?>" width="50" height="50">
					<!--判断该留言的uid是否是一个uniqid生成的id，如果不是,则找到用户对应的头像-->
						</div>
						<div style="float: left;width: 90%">
							<p style="display:block;float: left;width: 100% ;margin-bottom: 0">
								<span style="display:block;color: red;float: left;">
									<!--判断该评论的uid是否是一个uniqid生成的id，如果是该用户就是这个id-->
									<?php if (strlen($val['uid'])==13): ?>
										<?php echo $val['uid']; ?><span style="font-size: 12px;color: #ccc;">未登录用户</span>
									<?php endif; ?>
									<!--
									判断该评论的uid是否是一个uniqid生成的id，如果不是，那么该评论的uid出现在用户的uid，说明是注册用户，遍历出来-->
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
							<p style="margin-bottom: 0"><?php echo $val['content']; ?></p>
							<!--遍历楼层回复-->
							<?php if (!empty($res2)): ?>
							<?php foreach ($res2 as $value): ?>
								<?php if ($val['id']==$value['hid']): ?>
								<p class="p1" style="margin-bottom: 0">
								<span><?php foreach ($ures as $v): ?>
										<?php if ($value['uid']==$v['uid']): ?>
											<?php echo $v['username']; ?>
										<?php endif; ?>
									<?php endforeach; ?>：</span>
								<?php echo $value['content']; ?></p>
								<?php endif; ?>
							<?php endforeach; ?>
							<?php endif; ?>
							<form class="form" action="index.php?c=comment&a=docomment&id=<?php echo $id; ?>&hid=<?php echo $val['id']; ?>" method="post">
								<input type="text" name="content" placeholder="回复">
								<?php if (!empty($_SESSION['id'])): ?>
								<input type="submit" name="" value="回复">
								<?php endif; ?>
								<?php if (empty($_SESSION['id'])): ?>
								<a href="index.php?a=login" style="font-weight: 900">请登录回复</a>
								<?php endif; ?>
							</form>
						</div>
					</div>
					<?php endforeach; ?>
					<?php endif; ?>
					<!--遍历评论结束-->
					<div>
					<a href="index.php?a=blog01&page=<?php echo $url['first']; ?>" style="font-size: 18px;">首页</a>&nbsp;
					<a href="index.php?a=blog01&page=<?php echo $url['prev']; ?>" style="font-size: 18px;">上一页</a>&nbsp;
					<a href="index.php?a=blog01" style="font-size: 18px;"></a>
					<a href="index.php?a=blog01&page=<?php echo $url['next']; ?>" style="font-size: 18px;">下一页</a>&nbsp;
					<a href="index.php?a=blog01&page=<?php echo $url['end']; ?>" style="font-size: 18px;">尾页</a>
					</div>

				</div>
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /white -->
	
	
	
	
	<!-- +++++ Footer Section +++++ -->
	
	<?php include "cache/bc59cebe8abe9de1e53672022dfc901e.php" ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="public/js/bootstrap.min.js"></script>
  </body>
</html>
