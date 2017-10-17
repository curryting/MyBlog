<?php
namespace vendor;

class Upload
{
	//成员属性
	//文件路径
	protected $path = 'public/upload/';
	//允许的后缀名
	protected $allowSuffix = ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'wbmp'];
	//允许的MIME
	protected $allowMime = ['image/png', 'image/jpeg', 'image/gif', 'image/wbmp'];
	//允许的上传size
	protected $maxSize = 5000000;
	//是否启用随机的名字
	protected $isRandName = true;
	//文件前缀
	protected $prefix = 'up_';
	//是否启用日期目录
	protected $isDatePath = true;

	//自定义错误号和错误信息
	protected $errorNumber;
	protected $errorInfo;

	//要保存的文件信息
	//文件名
	protected $oldName;
	//文件后缀
	protected $suffix;
	//文件的mime
	protected $mime;
	//文件大小
	protected $size;
	//文件临时保存目录
	protected $tmpName;

	//文件的新名字和路径
	protected $newName;
	protected $newPath;

	//初始化成员属性
	//$arr = ['path' => 'upload', 'aaa', '123'];
	public function __construct($arr = [])
	{
		foreach ($arr as $key => $value) {
			$this->setOption($key, $value);

		}
	} 

	//判断$Key是不是我的成员属性 如是 设置之
	protected function setOption($key, $value)
	{
		$keys = array_keys(get_class_vars(__CLASS__));
		if (in_array($key, $keys)) {
			$this->$key = $value;
		}
	}

	//上传方法
	//参数：就是input的name值
	public function uploadFile($key)
	{
		//检测有没有设置path
		if (empty($this->path)) {
			$this->setOption('errorNumber', '-1');
			return false;
		}
		//判断路径是否是否存在可写
		if (!$this->checkDir()) {
			$this->setOption('errorNumber', '-2');
			return false;
		}
		//判断$_FILES里的错误号
		$error = $_FILES[$key]['error'];
		if ($error) {
			$this->setOption('errorNumber', $error);
			return false;
		} else {
			//提取文件相关信息
			$this->getFileInfo($key);
		}
		//判断大小是否超出最大size mime 后缀
		if ((!$this->checkSize()) || (!$this->checkMime()) || (!$this->checkSuffix())) {
			return false;
		}
		//得到新的文件名字和文件路径
		$this->newName = $this->createNewName();
		$this->newPath = $this->createNewPath();
		
		//判断是否是上传文件 移动文件
		if (is_uploaded_file($this->tmpName)) {
			if (move_uploaded_file($this->tmpName, $this->newPath.'/'.$this->newName)) {
				$this->setOption('errorNumber', '0');
				$newPath = $this->newPath.'/'.$this->newName;
				return $newPath;
			} else {
				$this->setOption('errorNumber', '-7');
			}
		} else {
			$this->setOption('errorNumber', '-6');
		}

	}
	protected function createNewPath()
	{
		if ($this->isDatePath) {
			$path = $this->path . date('y/m/d');
			if (!file_exists($path)) {
				mkdir($path, 0755, true);
			}
			return $path;
		} else {
			return $this->path;
		}
	}
	protected function createNewName()
	{
		if ($this->isRandName) {
			$name = $this->prefix . uniqid() . '.' . $this->suffix;
		} else {
			$name = $this->prefix . $this->oldName;
		}
		return $name;
	}

	//判断文件大小
	protected function checkSize()
	{
		if ($this->size > $this->maxSize) {
			$this->setOption('errorNumber', '-3');
			return false;
		}
		return true;
	}

	//判断文件mime
	protected function checkMime()
	{
		if (!in_array($this->mime, $this->allowMime)) {
			$this->setOption('errorNumber', '-4');
			return false;
		}
		return true;
	}

	//判断文件suffix
	protected function checkSuffix()
	{
		if (!in_array($this->suffix, $this->allowSuffix)) {
			$this->setOption('errorNumber', '-5');
			return false;
		}
		return true;
	}

	//判断路径是否是否存在可写
	//11/2/12
	//11
	//2
	//12
	protected function checkDir()
	{
		//文件不存在或者不是目录的画 我就创建一个
		if (!file_exists($this->path) || !is_dir($this->path)) {
			return mkdir($this->path, 0755, true);
		}	
		//判断是否可写
		if (!is_writable($this->path)) {
			return chmod($this->path, 0755);
		}
		return true;
	}

	protected function getFileInfo($key)
	{
		//取出文件mingzi
		$this->oldName = $_FILES[$key]['name'];
		//取mime
		$this->mime = $_FILES[$key]['type'];
		//取出临时路径
		$this->tmpName = $_FILES[$key]['tmp_name'];
		//取出大小
		$this->size = $_FILES[$key]['size'];
		//得到后缀
		$this->suffix = pathinfo($this->oldName)['extension'];
	}

	public function __get($name)
	{
		if ($name == 'errorNumber') {
			return $this->errorNumber;
		} else if ($name == 'errorInfo') {
			return $this->getErrorInfo();
		}
	}

	protected function getErrorInfo()
	{
		switch ($this->errorNumber) {
			case 0:
				$str = '上传成功';
				break;
			case 1:
				$str = '文件超过php.ini的大小';
				break;
			case 2:
				$str = '文件超过html的大小';
				break;
			case 3:
				$str = '部分文件悲伤传';
				break;
			case 4:
				$str = '没有文件被上传';
				break;
			case 6:
				$str = '找不到临时文件';
				break;
			case 7:
				$str = '文件写入失败';
				break;
			case -1:
				$str = '文件路径没设置';
				break;
			case -2:
				$str = '文件无权限或者不是目录';
				break;
			case -3:
				$str = '文件信息量太大';
				break;
			case -4:
				$str = '文件mime不符合';
				break;
			case -5:
				$str = '文件后缀不符合';
				break;
			case -6:
				$str = '文件不是上传文件';
				break;
			case -7:
				$str = '文件移动失败';
				break;
		}
		return $str;
	}

}
// $upload = new Upload();
// $upload->uploadFile('touxiang');
//echo $upload->errorNumber . '<br />';
//echo $upload->errorInfo;
