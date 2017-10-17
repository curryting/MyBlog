<?php

namespace model;
use vendor\Model;

class ArticleModel extends Model
{
	function add($data) 
	{
		return $this->insert($data);
	}

	function sel()
	{
		return $this->select();
	}

	//这个方法是用来操作文章的浏览数
	function dohits($id)
	{
		//创建model类
		$hits = $this->field('hits')->where("id=$id")->select()[0]['hits'];
		//浏览数加一
		$hits++;
		$arr = ['hits' => $hits];
		//重新修改数据库
		$a = $this->where("id=$id")->update($arr);
	}
}