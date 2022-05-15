<?php
/**
 * Mail 
 */
require_once 'lib/PHPMailer.php';
require_once 'lib/SMTP.php';
class Mail
{
	// 实例化PHPMailer核心类
	private $mail ;
	private $isRun;
	
	public function __construct(){
		$this->isRun = false;
		// 使用smtp鉴权方式发送邮件
		$this->mail  = new PHPMailer();
		$this->mail->isSMTP();
		// smtp需要鉴权 这个必须是true
		$this->mail->SMTPAuth = true;
	}
	/**
	* 服务器地址，发件人昵称，服务账号，服务密码，[端口号，编码类型，发件人邮箱(默认服务邮箱)]
	**/
	public function Opt($host,$fromName,$user,$pwd,$port = 25,$charset = 'UTF-8',$From=''){
		$this->isRun = true;
		// 链接qq域名邮箱的服务器地址
		$this->mail->Host = $host;
		 
		// 设置使用ssl加密方式登录鉴权
		$this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;//$secure;// ssl | tls
		 
		// 设置ssl连接smtp服务器的远程服务器端口号
		$this->mail->Port = $port;
		 
		// 设置发送的邮件的编码
		$this->mail->CharSet = $charset;

		// 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
		$this->mail->FromName = $fromName;
		 
		// smtp登录的账号 任意邮箱即可
		$this->mail->Username = $user;
		 
		// smtp登录的密码 使用生成的授权码
		$this->mail->Password = $pwd;
		$this->mail->From = $From;
		 
		// 邮件正文是否为html编码 注意此处是一个方法
		$this->mail->isHTML(true);

	}

	/**
	* 收件人地址，[主题，信息主题，附件]
	**/
	public function send($address,$sub,$msg=""){
		if (empty($address)) {
			die("邮箱地址错误");
		}else if(gettype($address)=='array'){
			foreach ($address as $value) {
				$this->mail->addAddress($value);
			}
		}else{
			$this->mail->addAddress($address);
		}
		$this->mail->Subject = ($sub);
		$this->mail->Body = ($msg);
		$this->mail->AltBody =($msg);
		
		$status = $this->mail->send();
		return $status;
	}
	public static function isRun(){
		return $this->isRun;
	}

}

 

 

 

 

 

 


