<?php
namespace app\test\controller;

//use think\Controller;
use think\Db;
use app\test\model\Test as TestModel;
use app\test\validate\Test as TestValidate;
// use app\test\validate\Edit as EditModel;
use app\test\controller\Base;

class Test extends Base
{
	public function index()
	{
		$user = new TestModel();
		$value = $user->order('id desc')->paginate(4,true);
        $page = $value->render();
        //halt($value->items());
     	$this->assign('list',$value);
        $this->assign('page',$page); 
        return $this->fetch('user\index');
	}

	public function add()
	{
		
		return $this->fetch('add');
	}

	 public function insert()
	 {
	 	$date = input('post.');
		//dump($date);die;
		$validate = new TestValidate();
		if(!$validate->check($date)){
			$this->error($validate->getError());
		}
		$userid = session('id');
		//dump($userid);die;
		$user 	  = new TestModel($date);
		//dump($user);die;
		$res 	  = $user->data([
			'user_id'	=> session('id'),
			'name'		=> session('name'),
			'title'		=> input('title'),
			'content'	=> input('content'),
		]);
		$result = $res->save();
		//dump($result);die;
		if(!$result){
			return $this->error('添加留言失败');
		}
		$this->success('添加留言成功','mine');
	 }

	 public function mine()
	{
		$userid = session('id');
		//dump($userid);die;
		$user 	  = new TestModel($userid);
		$value 	  = $user->where(['user_id' => $userid])->order('create_time desc')->paginate(4,true);
		$page     = $value->render();
		$this->assign('list',$value);
		$this->assign('page',$page);
		return $this->fetch('user\mine');
	}

	public function delete()
	{
		 $data = input('post.');
		 $id   = input('id');
		 $userid =session('user_id');
		 $user 	   = new TestModel($data);
		 $res = $user->where(['user_id' => $userid])->where(['id' => $id])->delete();
		 if(!$res){
		 	$this->error('删除留言失败');
		 }
		 $this->success('删除留言成功');
	}

	public function edit()
	{
		$id = input('id');
    	$user = TestModel::get($id);
    	$this->assign('user',$user);
    	return $this->fetch('user\edit');
	}

	public function update()
	{
		$data = input('post.');
		$id = input('id');
		$userid =session('id');
		//dump($userid);die;
		$user = new TestModel();
		//dump($user);die;
		$res = $user->where(['user_id' => $userid])->where(['id' => $id])->update($data);
		if($res){
			$this->success('修改成功','mine');
		}else{
			$this->error('修改失败');
		} 
		
	}

	// public function update()
	// {
	// 	$data = input('post.');
	// 	$id = input('id');
	// 	$user = TestModel::get($id);
	// 	$user->user->name = input('name');
	// 	$user->user->save();
	// }
}