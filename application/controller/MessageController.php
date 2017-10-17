<?php

namespace controller;
use model\MessageModel;

class MessageController
{
	//执行留言的方法
	public function domessage()
	{
		//接收post
		$arr = $_POST;
		//把需要插入数据库中的字段存入数组
		$arr['date'] = time();
		//判断用户有没有登录,没有登录给用户生成一个唯一的id
		if (!empty($_SESSION['id'])) {
			$arr['uid'] = $_SESSION['id'];
			$arr['photo'] = $_SESSION['photo'];
		} else {
			$arr['uid'] = uniqid();
		}
		//创建一个MessageModel对象
		$message = new MessageModel();
		//调用插入方法
		$res = $message->add($arr);
		if ($res) {
			$m = '留言成功';
			//header('refresh:2,url=index.php?a=message');
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=message");
		} else {
			$m = '留言失败';
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=message");
		}
	}
}