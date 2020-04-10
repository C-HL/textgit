<?php
namespace app\test\validate;

use think\Validate;

class User extends Validate
{
	protected $rule = [
        'name|用户名'  	=>  'require|max:8',
        'password|密码'	=>	'require|min:6|max:15|confirm:repassword',
        'email|邮箱' 	=>  'email',
    ];
     protected $message  =   [
        'name.require' 		=> '用户名不能为空',
        'name.max'     		=> '用户名最多不能超过8个字符',
        'password.require'	=> '密码不能为空',
        'password.min'		=> '密码不能少于6个字符',
        'password.max'		=> '密码不能超过15个字符',
        'password.confirm'	=> '两次密码不一致',
        'email'        		=> '邮箱格式错误',  
    ];

}