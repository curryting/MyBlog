<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>演示</title>
	<link rel="stylesheet" href="public/editor/css/editormd.css" />
	<script src="public/editor/js/jquery.min.js"></script>
	<script src="public/editor/editormd.min.js"></script>
	<script type="text/javascript">
	    $(function() {
	        testEditor = editormd("test-editormd", {
                    width   : "90%",
                    height  : 640,
                    syncScrolling : "single",
                    path    : "public/editor/lib/"
                });

	    });
	</script>
</head>
<body>
	<form action="index.php?c=article&a=dopublish<?php if (!empty($id)): ?>&id=<?php echo $id; ?><?php endif; ?><?php if (!empty($cid)): ?>&cid=<?php echo $cid; ?><?php endif; ?>" method="post">
		<span style="display:block;margin-left:75px;height: 35px;font-size: 16px;font-weight:bold;color: red;margin-top: 20px;">
			标题: <input type="text" name='title' style="height: 25px;width: 400px;border-radius: 5px;border:1px solid #ccc;" value="<?php if (!empty($ares)): ?><?php echo $ares['title']; ?><?php endif; ?>
			<?php if (!empty($sres)): ?><?php echo $sres['title']; ?><?php endif; ?>">
			请选择类型:
			<select name="category" style="height: 25px;font-size: 16px;border-radius: 5px;"
			>
				<option value="博文">个人日志</option>
				<option value="php" >php</option>
				<option value="html">html</option>
				<option value="javascript">javascript</option>
				<option value="c">c</option>
				<option value="篮球">篮球</option>
			</select>
			标签：<input type="text" name='tag' style="height: 25px;width: 200px;border-radius: 5px;border:1px solid #ccc;" value="<?php if (!empty($ares)): ?><?php echo $ares['tag']; ?><?php endif; ?><?php if (!empty($sres)): ?><?php echo $sres['tag']; ?><?php endif; ?>">
		</span>
		<div style="margin-left: 75px;">
			<textarea name="description" id="" cols="130" rows="4" placeholder='文章描述部分...' style="border-radius: 5px;font-size: 16px;padding-left: 5px;">
				<?php if (!empty($ares)): ?><?php echo $ares['description']; ?><?php endif; ?>
				<?php if (!empty($sres)): ?><?php echo $sres['description']; ?><?php endif; ?>
			</textarea>
		</div>
		<div class="editormd" id="test-editormd">
	    	<textarea style="display:none;" name="content"><?php if (!empty($ares)): ?><?php echo $ares['content']; ?><?php endif; ?>
	    	<?php if (!empty($sres)): ?><?php echo $sres['content']; ?><?php endif; ?>
	    	</textarea>
		</div>
		<span style="margin-left:75px;">
			<?php if (empty($id)): ?>
			<input type="submit" value="发表" style="width: 100px;height: 30px;background-color: #123;color: #fff;font-weight: bold;font-size: 16px;border:none;" name='add'>
			<?php endif; ?>
			<?php if (!empty($id)): ?>
			<input type="submit" value="修改" style="width: 100px;height: 30px;background-color: #123;color: #fff;font-weight: bold;font-size: 16px;border:none;" name='upd'>
			<?php endif; ?>
		</span>
	</form>
</body>
</html>