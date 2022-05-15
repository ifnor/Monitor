@echo off & title Monitor
CHCP 65001
mode con cols=80 lines=20
echo *********************************
echo *                           	*
echo *       欢迎使用  Monitor    	*
echo *                           	*
echo *        author:ceshon      	*
echo *                           	*
echo *********************************
echo.
echo.

if not exist  %~dp0\config.php (
	echo 请创建 congif.php 文件并按 README.md 文件进行配置
	echo.
	pause
	exit
)





%~dp0\php\php.exe %~dp0\start.php

pause
