<?php
//开启session
session_start();
//设置默认时区为中国
date_default_timezone_set('PRC');
//抑制所有错误信息
error_reporting(0);

//将配置文件加载进来
$config = include 'config/config.php';

//包含自动加载的类
include 'boot/Psr4AutoLoad.php';

//包含启动的类
include 'boot/Start.php';
