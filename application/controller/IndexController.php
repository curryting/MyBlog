<?php

namespace controller;
use model\UserModel;
use model\ArticleModel;
use model\CommentModel;
use model\MessageModel;
use model\ShareModel;
use model\ContentModel;
use model\CategoryModel;
use model\LinkModel;
use model\SiteModel;
use vendor\Code;

class IndexController extends Controller
{
	//首页
	function index()
	{
		//判断是否关闭站点
		$site = new SiteModel();
		$isclose = $site->select()[0]['isclose'];
		if ($isclose) {
			die("网站正在维修中。。。");
		}
		$this->helper('category');
		//调用公共部分展示数据的方法
		$this->publicShow();
		//展示首页
		$this->display();
	}
	//进行提示的方法
	function work()
	{
		$m = $_GET['m'];
		$time = $_GET['time'];
		$url = $_GET['url'];
		$url = str_replace('@', '?', $url);
		$url = str_replace('*', '&', $url);
		// var_dump($url);
		// die;
		$this->assign('m',$m);
		$this->assign('time',$time);
		$this->assign('url',$url);
		//调用公共部分展示数据的方法
		$this->publicShow();
		$this->display();
	}

	function share()
	{
		$this->helper('category');
		//调用公共部分展示数据的方法
		$this->publicShow();
		$this->display();
	}
	//博文列表
	function share_list()
	{
		//接收要遍历的类型id
		$cid = $_GET['cid'];
		$this->helper('share',"cid=$cid");
		//调用公共部分展示数据的方法
		$this->assign('cid',$cid);
		$this->publicShow();
		$this->display();
	}
	//关于页面
	function about()
	{
		//调用公共部分展示数据的方法
		$this->publicShow();
		$this->display();
	}
	//博客页面
	function blog()
	{
		//调用help方法
		$this->helper('article');
		//调用公共部分展示数据的方法
		$this->publicShow();
		$this->display();
	}
	//留言页面
	function message()
	{
		//调用工具类
		$this->helper('user');
		$this->helper('message');
		//调用公共部分展示数据的方法
		$this->publicShow();
		$this->display();
	}
	//归档页面	
	function file()
	{
		$i = $_GET['i'];

		//判断遍历哪一个类型
		if($i==0) {
				$this->helper('category');
				$this->helper('article');
				$this->helper('share');
			} else {
				$this->helper('category');
				$share = new ShareModel();
				$sres = $share->where("cid=$i")->select();
				$this->assign('sres',$sres);
		}
		
		//调用公共部分展示数据的方法
		$this->assign('i',$i);
		$this->publicShow();
		$this->display();
	}
	//搜索方法
	function search()
	{
		//执行查询搜索的方法
		$search = new SearchController();
		$res = $search->dosearch($_POST);
		$this->assign('res',$res);
		$this->publicShow();
		$this->display();
	}

	function photo()
	{
		//获取用户id
		$uid = $_SESSION['id'];
		$this->helper('user',"uid=$uid");
		//调用公共部分展示数据的方法
		$this->publicShow();
		$this->display();
	}
	//博客详情页面
	function blog01()
	{
		//接收get参数,文章id
		$id = $_GET['id'];
		//创建一个ArticleModel类
		$article = new ArticleModel();
		//查询article表
		$res = $article->where("id=$id")->select();
		
		//创建一个CommentModel类
		$comment = new CommentModel();
		
		//查询出评论总数
		$totalCount = $comment->counts();
		//创建分页类
		$page = new PageController(5,$totalCount);
		//得到limit
		$limit = $page->limit();
		//得到url
		$url = $page->allpage();
		//查询comment表
		$res1 = $comment->where("aid=$id and first=0")->limit($limit)->select();
		$res2 = $comment->where("aid=$id and first=1")->select();
		//调用浏览数加一方法
		$article->dohits($id);

		//调用helper方法
		$this->helper('user');

		$this->assign('url',$url);
		$this->assign('res',$res);
		$this->assign('id',$id);
		$this->assign('res1',$res1);
		$this->assign('res2',$res2);
		//调用公共部分展示数据的方法
		$this->publicShow();
		$this->display();
	}
	//分享页面详情
	function content()
	{
		$cid = $_GET['cid'];
		$sid = $_GET['sid'];

		//创建一个CommentModel类
		$content = new ContentModel();
		
		//查询出评论总数
		$totalCount = $content->counts();
		//创建分页类
		$page = new PageController(5,$totalCount);
		//得到limit
		$limit = $page->limit();
		//得到url
		$url = $page->allpage();
		//查询content表
		$cres = $content->where("sid=$sid and first=0")->limit($limit)->select();
		$cres1 = $content->where("sid=$sid and first=1")->select();

		// echo $content->sql;
		// var_dump($cres);
		// die;
		//查询出该文章的浏览数
		$share = new ShareModel();
		$hits = $share->field('hits')->where("id=$sid")->select()[0]['hits'];
		$hits++;
		$share->where("id=$sid")->update(['hits' => $hits]);

		//echo $content->sql;
		$this->helper('share',"id=$sid");
		$this->helper('user');
		//die;
		$this->assign('cid',$cid);
		$this->assign('sid',$sid);
		$this->assign('url',$url);
		$this->assign('cres',$cres);
		$this->assign('cres1',$cres1);
		//调用公共部分展示数据的方法
		$this->publicShow();
		$this->display();
	}
	//登录页面
	function login()
	{
		//调用公共部分展示数据的方法
		$this->publicShow();
		$this->display();
	}
	//注册页面
	function register()
	{
		//调用公共部分展示数据的方法
		$this->publicShow();
		$this->display();
	}
	//验证码页面
	function code()
	{
		$code = new Code();
		$code->outImage();
		//取出验证码字符串
		$str = $code->code;
		$_SESSION['code'] = $str;
	}

	//发表博客页面
	function publish()
	{
		//判断get是否为空，不为空的话是修改博文
		if (!empty($_GET['id'])) {
			$id = $_GET['id'];
			$article = new ArticleModel();
			$ares = $article->getById($id);	
			//判断cid是否为空，来判断是博文还是分享
			if (!empty($_GET['cid'])){
				$cid = $_GET['cid'];
				$share = new ShareModel();
				$sres = $share->getById($id);
				$this->assign('cid',$cid);
				$this->assign('sres',$sres);
			}		
			$this->assign('ares',$ares);
			$this->assign('id',$id);
		}
		
		//调用公共部分展示数据的方法
		$this->publicShow();
		$this->display();
	}
	//后台页面
	function admin_index()
	{
		//调用公共部分展示数据的方法
		$this->helper('user');
		$this->helper('article');
		$this->helper('share');
		$this->helper('message');
		$this->helper('comment');
		$this->helper('content');
		$this->helper('link');
		$this->helper('site');
		$this->publicShow();
		$this->display();
	}

	//这个方法封装的是每一个页面都需要的公共数据
	protected function publicShow()
	{
		//接收session里面的值
		if (!empty($_SESSION['username']) && $_SESSION['isblogger'] < 2) {
			$username = $_SESSION['username'];
			$isblogger = $_SESSION['isblogger'];
			$this->assign('username',$username);
			$this->assign('isblogger',$isblogger);

		}
		$this->helper('link');
	}
	//这个方法是用来创建用户表，留言表和文章表的，分别调用他们的查询方法的
	//只要是需要全部查询出来的，都可以调用这个类
	protected function helper($a,$where=null)
	{
		//实例化需要查询数据的类
		$user = new UserModel();
		$article = new ArticleModel();
		$message = new MessageModel();
		$shar = new ShareModel();
		$category = new CategoryModel();
		$comment = new CommentModel();
		$content = new ContentModel();
		$link = new LinkModel();
		$site = new SiteModel();
		//查询留言总数
		$totalCount = $message->counts();
		//创建分页类
		$page = new PageController(15,$totalCount);
		//得到limit
		$limit = $page->limit();
		//得到url->page
		$url = $page->allpage();
		//$comment = new CommentModel();
		switch ($a) {
			case 'user':
				$ures = $user->where($where)->sel();
				$this->assign('ures',$ures);
				break;
			case 'message':
				$mres = $message->limit($limit)->order("date desc")->sel();
				$mcounts = $message->field('count(id) as counts')->select();
				$this->assign('mcounts',$mcounts);
				$this->assign('mres',$mres);
				$this->assign('url',$url);
				break;
			case 'article':
				$ares = $article->order("date desc")->sel();
				$this->assign('ares',$ares);
				break;
			case 'share' :
				$sres = $shar->where($where)->order("date desc")->sel();
				$this->assign('sres',$sres);
				//echo $shar->sql;
				break;
			case 'category':
				$cres = $category->sel();
				$this->assign('cres',$cres);
				break;
			case 'comment':
				$pres = $comment->order("date desc")->select();
				$this->assign('pres',$pres);
				break;
			case 'content':
				$fres = $content->order("date desc")->select();
				$this->assign('fres',$fres);
				break;
			case 'link':
				$lres = $link->select();
				$this->assign('lres',$lres);
				break;
			case 'site':
				$site = $site->select();
				$this->assign('site',$site);
				break;
		}

	}
}