<?php

namespace controller;

use vendor\Tpl;

class Controller extends Tpl
{
	public function __construct()
	{
		$config = $GLOBALS['config'];
		//重新定义模板文件路径和缓存路径
		$tpl_view = $config['TPL_VIEW'];
		$tpl_cache = $config['TPL_CACHE'];

		//调用父类的方法
		parent::__construct($tpl_view, $tpl_cache);
	}

	public function display($viewName = null, $isInclude = true, $uri = null)
	{
		if (empty($viewName)) {
			$viewName = $_GET['a'] . '.html';
		}
		parent::display($viewName, $isInclude, $uri);
	}
}