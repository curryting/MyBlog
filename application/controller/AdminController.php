<?php

namespace controller;
use model\UserModel;
use model\ArticleModel;
use model\ShareModel;
use model\MessageModel;
use model\CommentModel;
use model\ContentModel;

class AdminController
{
	function user()
	{
		$option = $_GET['option'];
		$uid = $_GET['uid'];
		$user = new UserModel();
		//判断是操作什么
		switch ($option) {
			case 'del':
				//执行删除语句
				$user->where("uid=$uid")->delete();
				header("location:index.php?a=admin_index&i=0");
				break;
			
			case 'upd':
				//查询出$uid的数据
				$res = $user->getByUid($uid);
				if($res['islock']) {
					$user->where("uid=$uid")->update(['islock' => 0]);
				} else {
					$user->where("uid=$uid")->update(['islock' => 1]);
				}
				header("location:index.php?a=admin_index&i=0");
				break;
		}	
	}

	function article()
	{
		$option = $_GET['option'];
		$id = $_GET['id'];
		$article = new ArticleModel();
		//判断做什么操作
		switch ($option) {
			case 'del':
				//执行删除语句
				$article->where("id=$id")->delete();
				header("location:index.php?a=admin_index&i=1");
				break;
			
		}
	}
	//技术分享方法
	function share()
	{
		//删除操作
		$id = $_GET['id'];
		$share = new ShareModel();
		$share->where("id=$id")->delete();
		header("location:index.php?a=admin_index&i=2");
	}
	//留言方法
	function message()
	{
		//这是删除操作
		$id = $_GET['id'];
		$message = new MessageModel();
		$message->where("id=$id")->delete();
		header("location:index.php?a=admin_index&i=3");
	}
	//博客评论方法
	function comment()
	{
		$id =$_GET['id'];
		$comment = new CommentModel();
		$comment->where("id=$id")->delete();
		header("location:index.php?a=admin_index&i=4");
	}
	//技术评论分享
	function content()
	{
		$id =$_GET['id'];
		$content = new ContentModel();
		$content->where("id=$id")->delete();
		header("location:index.php?a=admin_index&i=5");
	}
}