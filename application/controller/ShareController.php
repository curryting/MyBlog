<?php

namespace controller;
use model\ShareModel;
use model\CategoryModel;

class ShareController
{
	public function option($data)
	{
		
		//$cid = $_GET['cid'];
		//判断分享的类型
		switch ($data['category']) {
			case 'php':
				$data['cid'] = 1;
				break;
			case 'html':
				$data['cid'] = 2;
				break;
			case 'javascript':
				$data['cid'] = 3;
				break;
			case 'c':
				$data['cid'] = 4;
				break;
			case '篮球':
				$data['cid'] = 5;
				break;
		}
		$cid = $data['cid'];
		//创建一个ShareModel类
		$sha = new ShareModel();

		//判断是执行删除还是修改
		if (empty($data['upd'])) {
			//存入分享时间
			$data['date'] = time();
			//调用插入方法
			$result = $sha->add($data);
			if ($result) {
				$m = "发表成功";
				//查询该板块下面的文章总数
				$res = $sha->field('count(id) as counts')->where("cid=".$data['cid'])->select();
				$counts = $res[0]['counts'];
				//修改数据库
				$category = new CategoryModel();
				$a = $category->where("cid=".$data['cid'])->update(['counts' => $counts]);
				//header('refresh:2,url=index.php');
				header("location:index.php?a=work&time=2&m=$m&url=index.php@a=share_list*cid=$cid");
			} else {
				$m = "发表失败";
				header("location:index.php?a=work&time=2&m=$m&url=index.php@a=publish");
			}
		} else {
				$id = $_GET['id'];
				$res = $sha->where("id=$id")->update($data);
				if ($res) {
					$m = "修改成功";
					header("location:index.php?a=work&time=2&m=$m&url=index.php@a=admin_index*i=2");
					//header("refresh:2,url=index.php?a=admin_index&i=2");
				} else {
					$m = "修改失败";
					header("location:index.php?a=work&time=2&m=$m&url=index.php@a=admin_index*i=2");
				}
		}

	}
}