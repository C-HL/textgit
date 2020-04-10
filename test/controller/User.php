<?php
namespace app\test\controller;

use think\Controller;
use think\Db;
use app\test\model\User as UsersModel;

class User extends Controller
{
	public function index()
	{
		$user = new UsersModel();
		$value = $user->order('id desc')->paginate(4,true);
        $page = $value->render();
        //halt($value->items());
     	$this->assign('list',$value);
        $this->assign('page',$page); 
        return $this->fetch('user\list');
	}

	public function edit()
    {
    	$id = input('id');
    	$user = UsersModel::get($id);
    	$this->assign('user',$user);
    	return $this->fetch('user\edit');
    }

   public function update()
	{
		$data = input('post.');
		$id = input('id');
		$name =session('name');
		//dump($userid);die;
		$user = new UsersModel();
		//dump($user);die;
		$res = $user->where(['name' => $name])->where(['id' => $id])->update();
		//dump($res);die;
		if($res){
			$this->success('修改成功','mine');
		}else{
			$this->error('修改失败');
		} 
		
	}

    public function delete()
	{
		 $data = input('post.');
		 $id   = input('id');
		 $userid =session('user_id');
		 $user 	 = new UsersModel($data);
		 $res = $user->where(['user_id' => $userid])->where(['id' => $id])->delete();
		 if(!$res){
		 	$this->error('删除留言失败');
		 }
		 $this->success('删除留言成功');
	}
}