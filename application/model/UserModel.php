<?php

namespace model;

use vendor\Model;

class UserModel extends Model
{
	//插入
	function add($data)
	{
		return $this->insert($data);
	}
	//查询
	function sel()
	{
		return $this->select();
	}
	//修改
	function upd($data)
	{
		return $this->update($data);
	}
	
}