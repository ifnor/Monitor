<?php
require 'service.php';

$config = require 'config.php';

$ww = new Monitor();
$ruleArr;
// echo sizeof($config['rules']);
// die();
if(is_array($config['websites'])&&is_array($config['rules'])){
	$ruleArr = array();
	foreach ($config['websites'] as $key => $website) {
		if(count($config['rules'])!=count($config['websites'])){die(PHP_EOL."规则和网站没有数量对应".PHP_EOL);}
		$ruleArr = array_merge(array($website => $config['rules'][$key]),$ruleArr);
	}
	
}else{
	$ruleArr = $config['rules'];
}

if($config['showSame']){
	$ww->NotShowSame();
}

if($config['MailRun']){
	$ww->mailOpt(
		$config['MailServer']['to'],
		$config['MailServer']['title'],
		$config['MailServer']['fromName'],
		$config['MailServer']['fromMail'],
		$config['MailServer']['server'],
		$config['MailServer']['port'],
		$config['MailServer']['charset'],
		$config['MailServer']['user'],
		$config['MailServer']['pwd']
	);
}

$ww->run($config['websites'],$ruleArr,$config['time']); //监控链接 正则规则 间隔时间(s) [charset]