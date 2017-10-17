<?php
/**
 * 这个类里 公共的方法只有一个 outImage 其他的方法定义成protected 供子类继承 重写
 * 有一些变量可以重复的用到 我们把它定义为成员属性
 */
namespace vendor;

class Code
{
	//验证码个数
	protected $number;
	//验证码类型
	protected $codeType;
	//验证码宽
	protected $width;
	//验证码高
	protected $height;
	//图片资源
	protected $image;
	//验证码
	protected $code;
	//图片类型
	protected $imageType;

	//初始化成员属性
	public function __construct($number=4, $codeType=2, $width=100, $height=50, $imageType='png')
	{

		$this->number = $number;
		$this->codeType = $codeType;
		$this->width = $width;
		$this->height = $height;
		$this->imageType = $imageType;
		//调用生成验证码字符串的方法
		$this->code = $this->getCode();
	}

	protected function getCode()
	{
		switch($this->codeType) {
			//纯数字
			case 0:
				$code = $this->getNumberCode();
				break;
			//纯子母
			case 1:
				$code = $this->getCharCode();
				break;
			//字母数字混合
			case 2:
				$code = $this->getNumCharCode();
				break;
			default:
				exit('不支持的的类型');
		}
		return $code;
	} 
	protected function getNumberCode()
	{
		$str = '0123456789';
		return substr(str_shuffle($str), 0, $this->number);
	}

	protected function getCharCode()
	{
		$str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle($str), 0, $this->number);
	}
	protected function getNumCharCode()
	{
		$arr1 = range('a', 'z');
		$arr2 = range(0, 9);
		$arr = array_merge($arr1, $arr2);
		shuffle($arr);
		$res = array_slice($arr, 0, $this->number);
		return join('', $res);
	}

	public function __get($name)
	{
		if ($name == 'code') {
			return $this->code;
		}
		return false;
	}

	public function outImage()
	{
		//生成画布
		$this->image = $this->createImage();
		//填充背景色
		$this->fillBackground();
		//画
		$this->drawChar();
		$this->drawGanrao();
		//输出
		$this->show();
	}

	protected function drawChar()
	{
		//$this->code; abcd
		for ($i=0; $i < $this->number; $i++) {
			$c = $this->code[$i];
			$width = ceil($this->width/$this->number);
			$x = mt_rand($i*$width+10, ($i+1)*$width-10);
			$y = mt_rand(0, $this->height-15);
			imagechar($this->image, 5, $x, $y, $c, $this->darkColor());
		}
	}

	protected function drawGanrao()
	{
		for ($i=0; $i<3; $i++) {

			imagearc($this->image, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0,100), mt_rand(0, 100), mt_rand(0, 180), mt_rand(180, 360), $this->darkColor());
		}
	}

	protected function createImage()
	{
		return imagecreatetruecolor($this->width, $this->height);
	}

	protected function fillBackground()
	{
		imagefill($this->image, 0, 0, $this->lightColor());
	}

	protected function lightColor()
	{
		return imagecolorallocate($this->image, mt_rand(150, 255), mt_rand(150, 255), mt_rand(150, 255));
	}

	protected function darkColor()
	{
		return imagecolorallocate($this->image, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120));
	}

	protected function show()
	{
		header('Content-Type:image/'.$this->imageType);
		$func = 'image' . $this->imageType;
		$func($this->image);

		//return $this->code;
	}
}

// $code = new Code();
// $str =  $code->outImage();
//echo $str;