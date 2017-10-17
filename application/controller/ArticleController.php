<?php
namespace controller;
use model\ArticleModel;
use controller\ShareController;

class ArticleController 
{
	function dopublish()
	{
		
		//判断是发表博文还是技术分享,如果是博文，则直接插入article表，如果不是，调用Share
		if ($_POST['category'] == '个人日志') {
			//创建model类
			$article = new ArticleModel();
			//用变量接收post值
			$arr = $_POST;
			//判断是删除还是修改
			if (empty($arr['upd'])) {
				//定义要插入数据库的值
				$arr['cid'] = 1;
				$arr['date'] = time();
				//调用插入方法
				$id = $article->add($arr);
				//echo $article->sql;
				if ($id) {
					$m = "发表成功";
					header("location:index.php?a=work&time=2&m=$m&url=index.php@a=blog");
				} else {
					$m = "发表失败";
					header("location:index.php?a=work&time=2&m=$m&url=index.php@a=publish");
				}
			} else {
				$id = $_GET['id'];
				$res = $article->where("id=$id")->update($arr);
				if ($res) {
					$m = "修改成功";
					header("location:index.php?a=work&time=2&m=$m&url=index.php@a=admin_index*i=1");
				} else {
					$m = "修改失败";
					header("location:index.php?a=work&time=2&m=$m&url=index.php@a=admin_index*i=1");
				}

			}
			
		} else {
			//创建ShareController方法
			$share = new ShareController();
			$share->option($_POST);
		}
	}
	
} 