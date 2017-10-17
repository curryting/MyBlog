<?php

namespace controller;
use model\CommentModel;
use model\ArticleModel;

class CommentController
{
	public function docomment()
	{
		//接收评论所属的文章id
		$id = $_GET['id'];
		if (empty($_POST)) {
			$m = '评论内容不能为空';
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=blog*id=$id");
		} 
		//接收post值
		$arr = $_POST;
		//把要插入数据库的字段存入数组
		$arr['aid'] = $id;
		$arr['date'] = time();
		//判断hid是否为空，来确定是否是回复
		if (!empty($_GET['hid'])) {
			$arr['hid'] = $_GET['hid'];
			$arr['first'] = 1;
		}
		if (empty($_SESSION['id'])) {
			$arr['uid'] = uniqid();
		} else {
			$arr['uid'] = $_SESSION['id']; 
			$arr['photo'] = $_SESSION['photo'];
		}
		//var_dump($arr['uid']);
		//创建一个CommentModel类
		$comment = new CommentModel();
		
		$res = $comment->add($arr);
		if ($res) {
			$m = "评论成功";
			//查询出评论总数,评论才计算,回复不计算
			if (empty($_GET['hid'])) {
				$replycount = $comment->field('count(id) as counts')->where("aid=$id and first=0")->select()[0]['counts'];
				$arr = ['replycount' => $replycount];
				$article = new ArticleModel();
				$article->where("id=$id")->update($arr);
			}
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=blog*id=$id");
		} else {
			$m = "插入失败";
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=blog*id=$id");
		}
	}
}