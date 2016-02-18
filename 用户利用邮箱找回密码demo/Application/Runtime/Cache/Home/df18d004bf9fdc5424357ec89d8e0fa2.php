<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>设置密码</title>
<style style type="text/css">
	*{font-family:"Microsoft YaHei",Arial,Helvetica,sans-serif,"宋体";} 
</style>

 </head>
 <body>
	<form action="<?php echo U('Email/doeditpwd');?>" method="post">
			密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 码：<input type="password" name='user_password'><br><br>
			确认密码：<input type="password" name='reuser_password'><br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="提交">
			
	</form>
 </body>
</html>