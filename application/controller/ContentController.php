<?php
namespace controller;

use model\ContentModel;
use model\ShareModel;

class ContentController
{
	function docomment()
	{
		$cid = $_GET['cid'];
		$sid = $_GET['sid'];
		if (empty($_POST)) {
			$m = '评论内容不能为空';
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=content*sid=$sid*cid=$cid");
			die();
		} 

		//接收post值
		$arr = $_POST;
		//把要插入数据库的字段存入数组
		$arr['cid'] = $cid;
		$arr['sid'] = $sid;
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

		//创建ContentModel类
		$content = new ContentModel();
		$result = $content->add($arr);
		
		if ($result) {
			$m = '评论成功';
			//查询出该文章对应的评论数量
			//查询出评论总数
			//查询出评论总数,评论才计算,回复不计算
			if (empty($_GET['hid'])) {
				$replycount = $content->field('count(id) as counts')->where("sid=$sid and first=0")->select()[0]['counts'];
				$arr = ['replycount' => $replycount];
				$share = new ShareModel();
				$share->where("id=$sid")->update($arr);
			}
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=content*sid=$sid*cid=$cid");
			//header("refresh:2,url=index.php?a=content&cid=$cid&sid=$sid");
		} else {
			$m = "评论失败";
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=content*sid=$sid*cid=$cid");
		}
	}
}