<?php


class Start
{
	//定义一个类属性，用来保存自动加载的类对象
	public static $auto;

	//根据传递的url来执行你想调用的方法
	static function router()
	{
		//得到控制器
		$c = empty($_GET['c']) ? 'index' : $_GET['c'];
		//得到方法名
		$a = empty($_GET['a']) ? 'index' : $_GET['a'];
		$_GET['c'] = $c;
		$_GET['a'] = $a;
		//得到类名
		$className = 'controller\\' . ucfirst($c) . 'Controller';
		//创建对象
		$obj = new $className();
		call_user_func([$obj,$a]);
	}

	//创建自动加载的对象方法
	static function init()
	{
		self::$auto = new Psr4AutoLoad();
	}
}

	//创建自动加载的对象
	Start::init();

	//在这里添加命名空间的映射
	Start::$auto->addMaps('controller', 'application/controller');
	Start::$auto->addMaps('model', 'application/model');
	Start::$auto->addMaps('vendor', 'vendor/lib');

	//开启路由
	Start::router();

	//设置默认时区为中国
	date_default_timezone_set('PRC');

