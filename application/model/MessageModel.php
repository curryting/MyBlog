<?php

namespace model;
use vendor\Model;

class MessageModel extends Model
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