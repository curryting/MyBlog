<?php

namespace model;
use vendor\Model;

class ShareModel extends Model
{
	public function add($data)
	{
		return $this->insert($data);
	}

	public function sel()
	{
		return $this->select();
	}

	
}