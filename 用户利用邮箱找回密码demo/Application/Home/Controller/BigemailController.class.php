<?php

/**
 *Author:duxingfeng;
 *Email:425100867@qq.com;
 *Opinion：邮件群发
 *Date:2015-8-25  15:00;
 */
namespace Home\Controller;

use Think\Controller;

class BigemailController extends Controller {
	public function index() {
		$map = 1;
		$info = M ( 'user' )->where ( $map )->getField ( 'email', true );
		
		$username = $info ['username'];
		$title = "十一大促销";
		
		$content = "<h3>十一大促销</h3>
			<br><br>哈哈哈哈哈哈哈哈
			<br><br>
			<img src='http://www.huabian.com/uploadfile/2014/0716/20140716101245193.jpg'>";
		
		$from = "425100867@qq.com"; // 修改为你的发送邮箱
		
		$i=0;$j=0;
		foreach ( $info as $k => $v ) {
			$status = send_mail ( $title, $content, $from, $v );
			if($status==1){
				$success[]=$v;
			}else{
				$error[]=$v;
			}
		}

		$this->assign ( 'succss', $success);
		$this->assign ( 'error', $error );
		$this->assign ( 'sum', ($k+1) );
		$this->display ();
	}
}

?>
