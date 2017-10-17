<?php

namespace controller;
use vendor\Upload;
use model\UserModel;

class UploadController extends Upload
{
	function dophoto()
	{
		//获取用户id
		$uid = $_SESSION['id'];
		//获取form表单中的name值
		$fileName = array_keys($_FILES)[0];
		//得到图片路径
		$photo = $this->uploadFile($fileName);
		//接收post值
		$arr = $_POST;
		//把照片传入数组
		if ($photo) {
			$arr['photo'] = $photo;
		}
		//修改时间
		$arr['mtime'] = time();
		//新建一个UserModel类
		$user = new UserModel();
		//调用修改方法,
		$result = $user->where("uid=$uid")->upd($arr);

		if ($result) {
			$m = "修改成功";
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=photo");
			die;
		} else {
			$m = "修改失败";
			header("location:index.php?a=work&time=2&m=$m&url=index.php@a=photo");
			die;
		}
	}
}