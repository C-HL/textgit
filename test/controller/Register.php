<?php
namespace app\test\controller;

use think\Controller;
use app\test\model\User as UsersModel;
use app\test\validate\User as UserValidate;

class Register extends Controller
{
	public function index()
	{
		return $this->fetch('index\register');
	}

	public function doRegister()
	{
		$data = input('post.');
		//dump($data);die;
		$validate = new UserValidate();
		if(!$validate->check($data)){
			$this->error($validate->getError());
		}
		$user = new UsersModel($data);
		//$user->save();
		//dump($user);die;
		$res  = $user->where('email',input('email'))->count();
		//dump($res);die;
		if($res > 0){
			 $this->error('邮箱已注册');
		}else{
			$result = $user->allowField(true)->save();
			//dump($result);die;
			if($result){
				$this->success('注册成功','index/index');
			}else{
				$this->error('注册失败');
			}
		}

	}

	
}