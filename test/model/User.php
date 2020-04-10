<?php
namespace app\test\model;

use think\Model;

class User extends Model
{

    protected $table = 'user';
    protected $autoWriteTimestamp = true;
    protected $updateTime = 'login_time';
    protected $loginTime = false;

	protected $auto = ['password','repassword'];

	protected function setPasswordAttr($value)
	{
		return md5($value);
	}

	protected function setRepasswordAttr($value)
	{
		return md5($value); 
	}

	public function test()
	{
		return $this->hasOne(Test::class,'user_id','id');
	}
}