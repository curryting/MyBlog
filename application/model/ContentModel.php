<?php
namespace model;
use vendor\Model;

class ContentModel extends Model
{
	public function add($data)
	{
		return $this->insert($data);
	}

	
}