<?php
namespace app\test\controller;

use think\Controller;

class Base extends Controller
{
	public function _initialize()
	{
		if(!session('id')){
			return $this->error('请登录','index/index');
		}
	}
}