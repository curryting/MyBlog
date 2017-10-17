<?php
namespace model;
use vendor\Model;

class CategoryModel extends Model
{
	function sel()
	{
		return $this->select();
	}

	function add($data)
	{
		return $this->insert($data);
	}

	function upd($data)
	{
		
	}
}