# Monitor

## What 
这是一个基于PHP的网页监控程序。环境是 PHP 7.4.29
> ###### 目前可用于：
> - 支持 Windows 、Linux
> * 直接加在的网页
> * 直接加载的页面
> * 直接加载的文件
## 已完成
*   Mail 📧
*   多网址
*   多规则

## ToDo
[ ] 权限网页
[ ] 后加载网页

## Use
> 需要自行配置文件目录的 config.php 
> 根据文件内示例 config-example.php 进行配置

```php
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
"MailRun"=> false//是否启用邮箱服务 默认不启用 true:启用 false:不启用
```

## Run In Your Device
- Windows
在配置完成 ```config.php``` 之后,双击运行 ```Start_TUI.bat```或```Start_TUI``` 文件即可

- Linux
需要自行配置PHP环境，配置完成之后,在终端中定位到文件目录，运行 ```php start.php```即可

## Running
> 在运行的时候，会打印/提示以下内容，这里做一下说明
-   ```service ok``` 提示这个,说明程序正在运行
-   ```update``` 提示这个开头的，证明文件已经
-   ```same``` 提示这个开头，即打开了未更新提示，默认打印 可在 ```config.php``` 内配置关闭