在发送邮件类的基础进行整合，找回密码功能可以防止篡改URL，以及URL有效时间为30分钟，可自行修改
打包下载（包含完整的thinkphp3.2.3），注意修改相应的数据库配置，即可运行

测试平台 php5.4 thinkphp3.2.3 qq邮箱，163邮箱，需要开启IMAP/SMTP服务， POP3/SMTP服务 
错误邮箱可以返回错误信息

邮件类放在 \test\ThinkPHP\Library\Com\Email
数据库配置 \test\Application\Home\Conf
发送函数  \test\Application\Common\Common\function.php 修改14，15行的内容
function.php 命名空间导入类不能继承Exception类，会报错
控制器修改 \test\Application\Home\Controller\EmailController.class.php  第41行
找回密码：http://test.com/index.php/Home/Email/
群发邮件：http://test.com/index.php/Home/Bigemail/

表的结构在test文件中

function send_mail ($title,$content,$from,$to,$chart='utf-8',$attachment ='') { 
	  
	  $mail = new PHPMailer(); 
	  $mail->CharSet = $chart; //设置采用gb2312中文编码 
	  $mail->IsSMTP('smtp'); //设置采用SMTP方式发送邮件 
	  $mail->Host = "smtp.qq.com"; //设置邮件服务器的地址 
	  $mail->Port = 25; //设置邮件服务器的端口，默认为25 
	  $mail->From = $from; //设置发件人的邮箱地址 
	  $mail->FromName = "发件人的姓名 "; //设置发件人的姓名 
	  $mail->SMTPAuth = true; //设置SMTP是否需要密码验证，true表示需要 
	  $mail->Username = "设置发送邮件的邮箱"; //设置发送邮件的邮箱 
	  $mail->Password = "XXXXXXXXXXXXXXXXX"; //设置邮箱的密码 
	  $mail->Subject = $title; //设置邮件的标题 
	  $mail->AltBody = "text/html"; // optional, comment out and test 
	  $mail->Body = $content; //设置邮件内容 
	  $mail->IsHTML(true); //设置内容是否为html类型 
	  $mail->WordWrap = 50; //设置每行的字符数 
	  $mail->AddReplyTo("地址","名字"); //设置回复的收件人的地址 
	  $mail->AddAddress($to,""); //设置收件的地址 
   if ($attachment != '') { 
     $mail->AddAttachment($attachment, $attachment); 
    } 
	if($mail->Send()) { 
		  $status= "$to".'&nbsp;&nbsp;已投送成功<br />';
	  } else { 
		  $status= "$to".'&nbsp;&nbsp;发送邮件失败<br />';
	} 
	return $array;

} 