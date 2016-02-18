<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>

	<form action="<?php echo U('Email/findpwd');?>" method="post">
			邮箱地址：<input type="text" name='email'><br>
			<input type="submit" value="提交">
	</form>

 </body>
</html>