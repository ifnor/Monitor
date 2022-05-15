<?php

return [
	//websites 和 rules 可以是字符串，即单一网站或者规则
	// "websites"=>"",
	"rules"=>"/[\x{4e00}-\x{9fa5}]+/u", //  "/[\x{4e00}-\x{9fa5}]+/u";  <-- 中文汉字正则
	"websites" =>[
		//网站需要添加协议名 http(s)://
		"https://www.baidu.com",
		"https://www.163.com"
	],
	// "rules"=>[
	// 	//正则表达式 需要和website进行一一对应
	// 	//顺序同website
	// ],
	"time"=>5,//间隔时间 单位秒
	"MailServer" =>[
		// to 收件人 可以是数组()多接收人, 可以是一个字符串作为邮箱
		// "to" =>"",
		"to"=>[],
		"title" => "", //邮件主题
		"fromName" =>"",//发件人名称
		"fromMail" =>"",//发件人邮箱
		"server"=>"",//邮箱服务器 eg:smtp.163.com
		"user" =>"",//邮箱服务器账号 eg: example@163.com
		"pwd" => "",//邮箱服务器密码或者服务密码
		"port"=>"",//邮箱服务器端口号 默认为25
		"charset"=>"UTF-8"//字符类型 默认为 UTF-8
	],
	"MailRun"=> false,//是否启用邮箱服务 默认不启用 true:启用 false:不启用
	"showSame"=>true //是否打印未更新时的提示 默认打印 true:打印 false:不打印

];
