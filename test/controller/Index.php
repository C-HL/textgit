<?php
namespace app\test\controller;

use think\Controller;
use think\Db;
use app\test\model\User as UsersModel;


class Index extends Controller
{
	public function Index()
	{

		return $this->fetch();
	}

	public function login()
	{
		$data = input('post.');
		$id = input('email');
		
		//dump($id);die;
		$user = new UsersModel();
		$time = time();
		//dump($time);die;
		$ret =$user->where(['email' => $id])->update(['login_time' => $time]);
		//dump($ret);die;
		$res  = $user->where('email',$data['email'])->find();
		//dump($res);die;
		if(empty($res)){
			$this->error('用户不存在');
		}elseif(!$res['password'] === md5($data['password'])){
			$this->error('密码错误');
		}elseif(!captcha_check($data['captcha'])){
 				$this->error('验证码不正确');
			}else{
				session('email',$res['email']);
				session('id',$res['id']);
				session('name',$res['name']);
				$this->success('验证成功,登陆中','User/mine');
			}

			
	}

	public function logout()
	{
		session(NULL);
		$this->success('退出登录成功','index');
	}
}