<?php

namespace controller;
use model\LinkModel;
use model\SiteModel;

class LinkController
{
	public function add()
	{
		$link = new LinkModel();
		$link->add($_POST);
		header("location:index.php?a=admin_index&i=6");
	}

	public function option()
	{

		$id = $_GET['id'];
		$link = new LinkModel();
		//判断是修改还是删除
		if (!empty($_POST['upd'])) {
			$a = $link->where("id=$id")->update($_POST);
			header("location:index.php?a=admin_index&i=6");
		} else {
			$link->where("id=$id")->delete();
			header("location:index.php?a=admin_index&i=6");
		}
	}

	public function site()
	{
		$site = new SiteModel();
		$site->update($_POST);
		header("location:index.php?a=admin_index&i=6");
	}
}