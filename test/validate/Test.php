<?php
namespace app\test\validate;

use think\Validate;

class Test extends Validate
{
	protected $rule = [
        'title|标题'		=>	'require|max:50',
        'content|内容'	=>	'require|max:100',
    ];
     protected $message  =   [ 
        'title.require'		=> '标题不能为空',
        'title.max'			=> '标题最多不能超过50个字符',
        'content.require'	=> '内容不能为空',  
        'content.max'		=> '内容最多不能超过100个字符',
    ];

}