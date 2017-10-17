<?php

namespace controller;

use model\UserModel;

class UserController
{
	function dojs () {
		$username = $_POST['username'];
		$user = new UserModel();
		$res = $user->getByUserName($username);
		if ($res) {
			echo json_encode(['status' => 1]);
		} else {
			echo json_encode(['status' => 0]);
		}
		
	}

	function doregister()
	{
		//var_dump($_POST);
		//判断post是否为空
		if (empty($_POST['username'])) {
			$m = '用户名不能为空';
			header("location:index.php?a=work&time=3&m=$m&url=index.php@a=register");
			die;
		}
		if (empty($_POST['password'])) {
			$m = '密码不能为空';
			header("location:index.php?a=work&time=3&m=$m&url=index.php@a=register");
			die;
		}
		if (strlen($_POST['username'])<=3 || strlen($_POST['username'])>14) {
			$m = '用户名过长或过短';
			header("location:index.php?a=work&time=3&m=$m&url=index.php@a=register");
			die;
		}
		
		if ($_POST['password'] != $_POST['repassword']) {
			$m = '两次输入的密码不匹配';
			header("location:index.php?a=work&time=3&m=$m&url=index.php@a=register");
			die;
		}
		//创建model类
		$user = new UserModel();
		//判断用户名是否存在
		$hello = $user->getByUsername($_POST['username']);
		if ($hello) {
			$m = '用户名已经被注册过了';
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=register");
			die;
		}
		//往数组中传递参数
		$arr = $_POST;
		$arr['regtime'] = time();
		$arr['mtime'] = time();
		//调用add方法，参数是$_POST
		$id = $user->add($arr);
		if ($id) {
			//注册成功，跳转到登录页面
			$m =  "恭喜你！注册成功,快去登录吧";
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=login");
			die;
		} else {
			$m = "注册失败";
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=register");
			die;
		}
	}

	function dologin()
	{
		//接收验证码字符串
		$code = $_SESSION['code'];
		//判断验证码是否为空
		if (empty($_POST['code'])) {
			$m = "请输入验证码";
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=login");
			die;
		}
		//判断验证码是否正确
		if (strcasecmp($_POST['code'], $_SESSION['code'])) {
			$m = "验证码不正确";
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=login");
			die;
		}

		if (empty($_POST['username'])) {
			$m = '用户名不能为空';
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=login");
			die;
		}
		if (empty($_POST['password'])) {
			$m = '密码不能为空';
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=login");
			die;
		}
		//接收前端传递过来的值
		$username = $_POST['username'];
		$password = $_POST['password'];
		//创建一个model类
		$user = new UserModel();
		//触动魔术方法__call
		$result = $user->getByUserName($username);
		if (!$result) {
			$m = '用户名不存在';
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=login");
			die;
		}
		//var_dump($result);
		if ($password != $result['password']) {
			$m = '密码不正确,请重新登录';
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=login");
			die;
		}
		//判断用户是否被锁定
		$islock = $result['islock'];
		if ($islock) {
			$m = '你用户名已经被锁定';
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=login");
			die;
		}
		//把用户名和id,isblogger存入到session
		$_SESSION['username'] = $username;
		$_SESSION['id'] = $result['uid'];
		$_SESSION['isblogger'] = $result['isblogger'];
		$_SESSION['photo'] = $result['photo'];
		//$_SESSION['age'] = $result['age'];
		$m = '登录成功';
		header("location:index.php?a=work&time=2&m=$m&url=index.php@a=index");
	}

	function delete_session()
	{
		session_destroy();
		$m = "退出成功";
		header("location:index.php?a=work&time=2&m=$m&url=index.php@a=index");
		die;
	}
}