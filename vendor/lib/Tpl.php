<?php

namespace vendor;

class Tpl
{
	//成员属性
	//视图文件存放的路径
	protected $viewDir;
	//缓存文件存放的路径
	protected $cacheDir;
	//缓存文件的过期时间
	protected $lifeTime;
	//前端要展示的数据，存放变量数组中
	protected $vars = [];
	
	public function __construct($viewDir = './view', $cacheDir = './cache', $lifeTime = 0)
	{
		//判断文件夹是否存在，是否是目录，是否可读写
		if (!$this->checkDir($viewDir) || !$this->checkDir($cacheDir)) {
			die('文件夹有问题，不符合要求');
		}
		
		//赋值，保存到成员属性中
		$this->viewDir = $viewDir;
		$this->cacheDir = $cacheDir;
		$this->lifeTime = $lifeTime;
	}
	
	protected function checkDir($path)
	{
		if (!file_exists($path) || !is_dir($path)) {
			return mkdir($path, 777, true);
		}
		
		if (!is_readable($path) || !is_writeable($path)) {
			return chmod($path, 777);
		}
		
		return true;
	}
	
	//成员方法
	//从数据库中得到的数据通过assign方法保存到成员属性vars中
	//$title = '今天'  $tpl->assign('title', $title);
	public function assign($name, $value)
	{
		$this->vars[$name] = $value;
	}
	
	//展示模板的方法
	// $viewName : 要展示的模板文件
	// $uri : page=4
	// 生成到缓存文件名中，保证每一页都是一个不同的缓存文件
	public function display($viewName, $isInclude = true, $uri = null)
	{
		//拼接视图文件的全路径
		$viewPath = rtrim($this->viewDir, '/') . '/' . $viewName;
		//判断视图文件是否存在
		if (!file_exists($viewPath)) {
			die('二货，模板文件不存在');
		}
		
		//生成缓存文件
		//生成缓存文件名
		$cacheName = md5($viewName . $uri) . '.php';
		//生成缓存文件全路径
		$cachePath = rtrim($this->cacheDir, '/') . '/' . $cacheName;
		//（判断缓存文件是否需要生成）
		//如果缓存文件不存在，直接生成
		if (!file_exists($cachePath)) {
			//读取视图文件的内容
			//通过正则替换视图文件中的模板语法，替换为php的语法
			$php = $this->compile($viewPath);
			//然后将替换后的内容写入到缓存文件中
			file_put_contents($cachePath, $php);
		} else {
			//如果缓存文件存在，判断是否过期或者视图文缓存否被修改过，满足一个重新生成缓存
			$isguoqi = (filemtime($cachePath) + $this->lifeTime > time()) ? false : true;
			$ischange = filemtime($viewPath) > filemtime($cachePath) ? true : false;
			//如果满足其中一个要求，缓存就要重新生成
			if ($isguoqi || $ischange) {
				$php = $this->compile($viewPath);
				file_put_contents($cachePath, $php);
			}
		}
		
		//将缓存文件include进来即可
		if ($isInclude) {
			extract($this->vars);
			include $cachePath;
		}
	}
	
	//将模板语法替换为php语法
	protected function compile($path)
	{
		//读取视图文件的内容
		$content = file_get_contents($path);
		//正则替换之
		//将正则和要替换的内容写成一个数组的形式
		// {$%%} ======> #\{\$(.+?)\}#   #\{\$%%\}#
		$arr = [
			'{$%%}' => '<?php echo $\1; ?>',
			'{if %%}' => '<?php if (\1): ?>',
			'{else}' => '<?php else: ?>',
			'{/if}' => '<?php endif; ?>',
			'{foreach %%}' => '<?php foreach (\1): ?>',
			'{/foreach}' => '<?php endforeach; ?>',
			'{include %%}' => '这就是用户忽悠你的',
		];
		
		//遍历$arr,将键修改为标准的正则表达式，然后将值替换正则表达式匹配到的内容
		foreach ($arr as $key => $value) {
			//将key修改为标准的正则表达式
			$pattern = '#' . str_replace('%%', '(.+?)', preg_quote($key)) . '#';
			if (strstr($pattern, 'include')) {
				//对include进行单独处理
				$content = preg_replace_callback($pattern, [$this, 'parseInclude'], $content);
			} else {
				//正则替换
				$content = preg_replace($pattern, $value, $content);
				/*$content = preg_replace('#\{\$(.+?)\}#', '<?php echo $\1; ?>', $content); //*/
			}
		}
		
		//将替换好的内容返回即可
		return $content;
	}
	
	protected function parseInclude($data)
	{
		//获取视图文件名
		$name = trim($data[1], '\'"');
		//将这个文件生成缓存
		$this->display($name, false);
		//获取到缓存的文件名
		$cacheName = md5($name) . '.php';
		$cachePath = rtrim($this->cacheDir, '/') . '/' . $cacheName;
		return '<?php include "' . $cachePath . '" ?>';
	}
}












