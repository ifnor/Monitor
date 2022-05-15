<?php
echo date("Y-m-d H:i:s",time());
error_reporting(E_ALL);
set_time_limit(0);// 设置超时时间为无限,防止超时
date_default_timezone_set('Asia/shanghai');
// die();
require_once 'Mail.php';
class Monitor{
    private $url = "";
    private $time;
    private $oldHASH = array();
    private $mailSetting;
    private $mailIsRun = false;
    private $showSame = true;
    private function sha256($str=''){
    	return hash("sha256", $str);
    }
    
	public function run($url,$rules,$time,$params = NULL,$charser = 'UTF-8'){
		$this->time = time();
		try{
			if(is_array($url)){
				foreach ($url as  $value) {
					$this->oldHASH = array_merge(array($value => ''),$this->oldHASH);
				}
			}else{
				$this->oldHASH = $this->oldHASH;
			}
			echo "service ok".PHP_EOL;
		}catch(\Exception $e){
			die("启动失败");
		}

		for(;;) {
			if($this->time+$time <=time()){
				$this->time = time();
				if (is_array($url)) {
					foreach ($url as $index) {
						$html = file_get_contents($index);
						if(is_array($rules)){
							preg_match_all($rules[$index],$html,$out);
						}else{
							preg_match_all($rules,$html,$out);
						}
						$string = implode('',$out[0]) ;
						if($this->oldHASH[$index]!= $this->sha256($string)){
						    $this->oldHASH[$index] = $this->sha256($string);
						    $this->saveTime(time());
						    echo "update:".date("Y-m-d H:i:s",time())."-". $index .PHP_EOL;
						    if($this->mailIsRun){
						    	$this->mailTo($this->mailSetting,"update:".date("Y-m-d H:i:s",time()));
						    }
						}else {
							if($this->showSame){
								echo "same:".date("Y-m-d H:i:s",time()).'-'.$index .PHP_EOL;
							}  
						}
					}

				}else{
					$html = file_get_contents($url);
					preg_match_all($rules,$html,$out);
					$string = implode('',$out[0]) ;
					echo $string;
					if($this->oldHASH!= $this->sha256($string)){
					    $this->oldHASH = $this->sha256($string);
					    $this->saveTime(time());
					    echo "update:".date("Y-m-d H:i:s",time()).PHP_EOL;
					    if($this->mailIsRun){
					    	$this->mailTo($this->mailSetting,"update:".date("Y-m-d H:i:s",time()));
					    }
					}else {
						if($this->showSame){
							echo "same:".date("Y-m-d H:i:s",time()).PHP_EOL;
						}
					}
				}
			}
			sleep($time);
		}
	}

	private function saveTime($time){
		$filename = 'time.html';
		$fp= fopen($filename, "w");  //w是写入模式，文件不存在则创建文件写入。
		fwrite($fp, "更新于:" . date("Y-m-d H:i:s",$time));
		// fwrite($fp, $time);
		fclose($fp);
	}

	//收件人 主题 发件人名称 发件人邮箱 服务器地址 端口 字符类型 账号 密码
	public function mailOpt($to,$title,$from = "Monitor Bot",$formMail,$host,$port,$charset,$user,$pwd){
		$this->mailIsRun = true;
		$this->mailSetting = [
			"to" =>$to,
			"title" => $title,
			"from" => $from,
			"mail" =>$formMail,
			"host"  => $host,
			"port"  => $port,
			"charset"  => $charset,
			"user"  => $user,
			"pwd"  => $pwd
		];
	}

	private function mailTo($opt,$msg){
		$mail = new Mail();
		$mail ->Opt($opt['host'],$opt['from'],$opt['user'],$opt['pwd'],$opt['port'],$opt['charset'],$opt['mail']);
		if ($mail->send($opt['to'],$opt['title'],$msg)) {
			echo "此邮件已发送".PHP_EOL;
		}
	}
	public function NotShowSame(){
		$this->showSame = false;
	}
}




