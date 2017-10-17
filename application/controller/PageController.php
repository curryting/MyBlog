<?php

namespace controller;
use vendor\Page;

class PageController extends Page
{
	public function __construct($number=5, $totalCount=60)
	{
		parent::__construct($number,$totalCount);
	}
}