<?php
namespace controller;
use model\ArticleModel;
use model\ShareModel;

class SearchController
{
	public function dosearch($data)
	{
		//接收参数
		$search = $data['search'];
		$article = new ArticleModel();
		$share = new ShareModel();
		//查询个人日志
		$res1 = $article->where("title like '%" .$search. "%' or content like '%".$search."%' or tag like '%".$search."%' or description like '%".$search."%'")->select();
		
		//$res2 = $article->where("content like '%" .$search. "%'")->select();
		//$res3 = $article->where("tag like '%" .$search. "%'")->select();
		//合并多个数组
		$res2 = $share->where("title like '%" .$search. "%'")->select();
		
		$res = array_merge($res1,$res2);
		
		return $res;
	}
}