<?php

class Psr4AutoLoad
{
	//这个数组用来保存命名空间的映射结构
	protected $maps = [];

	//构造方法,创建对象就注册一个自己的方法来实现自动加载
	function __construct()
	{
		spl_autoload_register([$this, 'myautoload']);
	}

	function myautoload($name)
	{
		// abc\controller \ IndexController
		// 首先找到最后一个 \ 的位置
		$pos = strrpos($name,'\\');
		//获取命名空间
		$namespace = substr($name, 0, $pos);
		//获取真正的类名
		$className = substr($name, $pos + 1);

		//去映射目录中找对应的目录结构
		$path = $this->mapLoad($namespace);

		//拼接完整的文件名
		$filePath = $path . $className . '.php';
		
		//将该文件包含进来
		if (file_exists($filePath)) {
			include $filePath;
		} else {
			die('亲，该文件不存在');
		}
	}

	//从命名空间映射数组中查找对应的目录结构
	protected function mapLoad($namespace)
	{
		if (array_key_exists($namespace, $this->maps)) {
			return rtrim($this->maps[$namespace], '/') . '/';
		}

		return rtrim($namespace, '/') . '/';
	}

	//外部通过调用这个方法进行命名空间映射的添加
	public function addMaps($namespace, $path)
	{
		if (array_key_exists($namespace, $this->maps)) {
			die('亲，该命名空间映射已经添加过');
		}
		//添加进去
		$this->maps[$namespace] = $path;
	}
}