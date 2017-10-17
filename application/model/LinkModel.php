<?php

namespace model;
use vendor\Model;

class LinkModel extends Model
{
	function add($data)
	{
		return $this->insert($data);
	}
}