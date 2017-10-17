<?php

namespace model;
use vendor\Model;

class CommentModel extends Model
{
	public function add($data)
	{
		return $this->insert($data);
	}

}