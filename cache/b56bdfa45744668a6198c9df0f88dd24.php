<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		
		<link rel="stylesheet" type="text/css" href="public/admin/css/style-1.0.0.css"/>
		<style type="text/css">
			#box a{text-decoration: none;color: #444;}
		</style>
		

		<script type="text/javascript">
			window.onload=function(){
				var box=document.getElementById('box');
				// var lis=box.getElementsByTagName('li');
				var a=box.getElementsByTagName('a');
				var bigbox=document.getElementById('bigbox');
				var divs=bigbox.getElementsByTagName('div');
				var header=document.getElementById('header-wrapper');

				var url=location.search;
				//遍历使得左侧点击切换右侧内容
				var b=url.lastIndexOf('=');
				var i=url.substr(b+1);
				for(var k=0;k<a.length;k++){
					a[k].style.background='#eaedf1';
				}
				a[i].style.background='#fff';
				for(var n=0;n<divs.length;n++){
					divs[n].style.display='none';
				}

				divs[i].style.display='block';

				//监控滚动条，滚动条滚动时左侧和上面不动
				window.onscroll=function(){
					var scrollTop=document.documentElement.scrollTop || document.body.scrollTop;
					if(scrollTop>0){
						header.style.position='fixed';
						header.style.top=0;
						// header.style.left=0;
						box.style.height='1000px';
					}
					console.log(scrollTop);
					
				}

			}
		</script>
	</head>
	<body>
		<div id="header-wrapper">
			<div id="header">
				<h3 style="overflow: hidden;">
					<span style="float: left;">
						<a href="index.php?a=admin_index&i=0" style="text-decoration: none;color: #fff;">首页</a>
					</span>
					<span style="float: left;margin-left: 100px;">博客后台管理</span>
					<span style="float: right;">
						<a href="index.php" style="text-decoration: none;color: #fff;">退出</a>
					</span>
				</h3>
			</div>
		</div>
		
		
		<!--左侧导航-->
		
		<!-- <div id="box">
				<ul>
					<li class="li1"><a href="index.php?a=admin_index&i=0">用户管理</a></li>
					<li><a href="index.php?a=admin_index&i=1">博客管理</a></li>
					<li><a href="index.php?a=admin_index&i=2">技术分享管理</a></li>
					<li><a href="index.php?a=admin_index&i=3">留言管理</a></li>
					<li><a href="index.php?a=admin_index&i=4">博客评论管理</a></li>
					<li><a href="index.php?a=admin_index&i=5">技术评论管理</a></li>
					<li><a href="index.php?a=admin_index&i=6">友情链接</a></li>
				</ul>
	
		</div> -->
		<div id="box">
					<a href="index.php?a=admin_index&i=0" class="li1">用户管理</a>
					<a href="index.php?a=admin_index&i=1">博客管理</a>
					<a href="index.php?a=admin_index&i=2">技术分享管理</a>
					<a href="index.php?a=admin_index&i=3">留言管理</a>
					<a href="index.php?a=admin_index&i=4">博客评论管理</a>
					<a href="index.php?a=admin_index&i=5">技术评论管理</a>
					<a href="index.php?a=admin_index&i=6">友情链接</a>
				
	
		</div>
		
		
		<!--右侧-->
		<div id="bigbox">
			<div class='box1'>
				<table cellspacing="0">
					<tr>
						<th width="80">id</th>
						<th width="150">用户名</th>
						<th width="80">年龄</th>
						<th width="150">头像</th>
						<th width="150">注册时间</th>
						<th width="150">资料修改时间</th>
						<th width="">操作</th>
						<th width="">操作</th>
					</tr>
					<?php if (!empty($ures)): ?>
					<?php foreach ($ures as $val): ?>
					<tr>
						<td><?php echo $val['uid']; ?></td>
						<td><?php echo $val['username']; ?></td>
						<td><?php echo $val['age']; ?></td>
						<td class="img1"><img src="<?php echo $val['photo']; ?>" height="50" width="70" /></td>
						<td><?php echo $time=date('Y月m月d日 H:i:s',$val['regtime']); ?></td>
						<td><?php echo $time=date('Y月m月d日 H:i:s',$val['mtime']); ?></td>
						<td class="delete">
							<a href="index.php?c=admin&a=user&option=upd&uid=<?php echo $val['uid']; ?>" style="text-decoration: none;">
								<?php if ($val['islock']!=1): ?>
									锁定用户
								<?php endif; ?>
								<?php if ($val['islock']): ?>
									恢复用户
								<?php endif; ?>
							</a>
						</td>
						<td class="delete" >
							<a href="index.php?c=admin&a=user&option=del&uid=<?php echo $val['uid']; ?>" style="text-decoration: none;">删除</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</table>
			</div>
			<div>
				<table cellspacing="0">
					<tr>
						<th>id</th>
						<th>标题</th>
						<th>标签</th>
						<th>描述</th>
						<th>日期</th>
						<th>评论数</th>
						<th>浏览数</th>
						<th>操作</th>
						<th>操作</th>
					</tr>
					<?php if (!empty($ares)): ?>
					<?php foreach ($ares as $val): ?>
					<tr>
						<td><?php echo $val['id']; ?></td>
						<td><?php echo $val['title']; ?></td>
						<td><?php echo $val['tag']; ?></td>
						<td><?php echo $val['description']; ?></td>
						<td><?php echo $time=date('Y年m月d日 H:i:s',$val['date']); ?></td>
						<td><?php echo $val['replycount']; ?></td>
						<td><?php echo $val['hits']; ?></td>
						<td class="delete"><a href="index.php?c=admin&a=article&option=del&id=<?php echo $val['id']; ?>">删除</a>
						</td>
						<td class="delete"><a href="index.php?a=publish&id=<?php echo $val['id']; ?>">修改</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</table>
				
			</div>
			<div>
				
				<table cellspacing="0">
					<tr>
						<th>id</th>
						<th>分类的cid</th>
						<th>标题</th>
						<th>描述</th>
						<th>标签</th>
						<th>发表时间</th>
						<th>评论数</th>
						<th>浏览数</th>
						<th>操作</th>
						<th>操作</th>
					</tr>
					<?php if (!empty($sres)): ?>
					<?php foreach ($sres as $val): ?>
					<tr>
						<td><?php echo $val['id']; ?></td>
						<td><?php echo $val['cid']; ?></td>
						<td><?php echo $val['title']; ?></td>
						<td><?php echo $val['description']; ?></td>
						<td><?php echo $val['tag']; ?></td>
						<td><?php echo $time=date('Y月m月d日 H:i:s',$val['date']); ?></td>
						<td><?php echo $val['replycount']; ?></td>
						<td><?php echo $val['hits']; ?></td>
						<td><a href="index.php?a=publish&id=<?php echo $val['id']; ?>&cid=<?php echo $val['cid']; ?>">修改</a></td>
						<td><a href="index.php?c=admin&a=share&id=<?php echo $val['id']; ?>">删除</a></td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</table>
			</div>
			<div>
				<table cellspacing="0">
					<tr>
						<th>id</th>
						<th>用户uid</th>
						<th>留言内容</th>
						<th>留言时间</th>
						<th>用户头像</th>
						<th>操作</th>
					</tr>
					<?php if (!empty($mres)): ?>
					<?php foreach ($mres as $val): ?>
					<tr>
						<td><?php echo $val['id']; ?></td>
						<td><?php echo $val['uid']; ?></td>
						<td><?php echo $val['content']; ?></td>
						<td><?php echo $time=date('Y年m月d日 H:i:s',$val['date']); ?></td>
						<td class="img1"><img src="<?php echo $val['photo']; ?>"/></td>
						<td class="delete""><a href="index.php?c=admin&a=message&id=<?php echo $val['id']; ?>">删除</a></td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</table>
			</div>
			<div>
				<table cellspacing="0">
					<tr>
						<th>id</th>
						<th>文章aid</th>
						<th>用户uid</th>
						<th>用户照片</th>
						<th>内容</th>
						<th>评价时间</th>
						<th>操作</th>
					</tr>
					<?php if (!empty($pres)): ?>
					<?php foreach ($pres as $val): ?>
					<tr>
						<td><?php echo $val['id']; ?></td>
						<td><?php echo $val['aid']; ?></td>
						<td><?php echo $val['uid']; ?></td>
						<td class="img1"><img src="<?php echo $val['photo']; ?>"/></td>
						<td><?php echo $val['content']; ?></td>
						<td><?php echo $time=date('Y年m月d日 H:i:s',$val['date']); ?></td>
						<td class="delete"><a href="index.php?c=admin&a=comment&id=<?php echo $val['id']; ?>">删除</a></td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</table>
			</div>
			<div>
				<table cellspacing="0">
					<tr>
						<th>id</th>
						<th>分类的cid</th>
						<th>文章sid</th>
						<th>用户uid</th>
						<th>用户照片</th>
						<th>内容</th>
						<th>评价时间</th>
						<th>操作</th>
					</tr>
					<?php if (!empty($fres)): ?>
					<?php foreach ($fres as $val): ?>
					<tr>
						<td><?php echo $val['id']; ?></td>
						<td><?php echo $val['cid']; ?></td>
						<td><?php echo $val['sid']; ?></td>
						<td><?php echo $val['uid']; ?></td>
						<td class="img1"><img src="<?php echo $val['photo']; ?>"/></td>
						<td><?php echo $val['content']; ?></td>
						<td><?php echo $time=date('Y年m月d日 H:i:s',$val['date']); ?></td>
						<td class="delete"><a href="index.php?c=admin&a=content&id=<?php echo $val['id']; ?>">删除</a></td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</table>
			</div>

			<div>
				<table cellspacing="0">
					<tr>
						<th>顺序</th>
						<th>站点名称</th>
						<th>站点url</th>
						<th>文字说明（可选）</th>
						<th>操作</th>
					</tr>
					<form action="index.php?c=link&a=add" method="post">
						<tr>
							<td><input type="number" name="oid"></td>
							<td><input type="text" name="name"></td>
							<td><input type="text" name="url"></td>
							<td><input type="text" name="description"></td>
							<td></td>
						</tr>
						<tr>
							<td>
								<input type="submit" value="添加">
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</form>
						<?php if (!empty($lres)): ?>
						<?php foreach ($lres as $val): ?>
						<form action="index.php?c=link&a=option&id=<?php echo $val['id']; ?>" method="post">
							<tr>
								<td><input type="number" name="oid" value="<?php echo $val['oid']; ?>"></td>
								<td><input type="text" name="name" value="<?php echo $val['name']; ?>"></td>
								<td><input type="text" name="url" value="<?php echo $val['url']; ?>"></td>
								<td><input type="text" name="description" value="<?php echo $val['description']; ?>"></td>
								<td>
									<input type="submit" name="upd" value="修改">
									<input type="submit" name="del" value="删除">
								</td>
							</tr>
						</form>
						
						<?php endforeach; ?>
						<?php endif; ?>
						<form action="index.php?c=link&a=site" method="post">
						<tr><td colspan="5">站点信息</td></tr>
						<tr>
							<td>网站名称：<input type="text" name="name" value="<?php echo $site[0]['name']; ?>"></td>
							<td>网站url：<input type="text" name="url" value="<?php echo $site[0]['url']; ?>"></td>
							<td>网站备案代码：<input type="text" name="icp" value="<?php echo $site[0]['icp']; ?>"></td>
							<td colspan="2">
								关闭站点：
								<input type="radio" name="isclose" id="shi" value='1' <?php if ($site[0]['isclose']==1): ?>checked<?php endif; ?>><label for="shi" >是</label>
								<input type="radio" name="isclose" id="fou" value='0' <?php if ($site[0]['isclose']==0): ?>checked><?php endif; ?><label for="fou">否</label>
							</td>
						</tr>
						<tr>
							<td><input type="submit" name="site"></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</form>
				</table>
			</div>
		</div>
			
	</body>
</html>
