<?php
   //招聘公告详情页做上下条查找
    public function zpgg(){
        $notice = M("Notice");
        //获取路由的gg_id
        $gg_id = I('get.gg_id');
        if(!$gg_id){
            $this->error("没有了");
            exit;
        }
        $ggxq = $notice->where("type=2 and id=$gg_id")->find();
        //获取下一条数据的id
        $ggxq_next = $notice->where("type=2 and id>$gg_id")->getField("id");
        //获取上一条数据的id,这里一定要让数据倒排序过来
        $ggxq_lastone = $notice->where("type=2 and id<$gg_id")->order("id desc")->getField("id");
        
        $this->assign('ggxq',$ggxq);
        $this->assign('ggxq_next',$ggxq_next);
        $this->assign('ggxq_lastone',$ggxq_lastone);
        $this->display();
    }
	
	
	//邀请码添加
    public function add() {
        for ($i = 1; $i < 100; $i++) {
            //用md5方式做唯一（32）位邀请码，并用字符串截取出10个
            $data[] = substr(md5(uniqid(microtime(true), true)), 0, 10);
            //定义一个数组，值为code
            $code[] = "code";
            //将$code里值和$data里的值互换
            $tmp = array_combine($data, $code);
            //然后将$tmp的键和值互换
            $res[$i] = array_flip($tmp);
            //把100个邀请码赋值操作员
            $res[$i]['create_by'] = get_uid();
            $res[$i]['is_delete'] = 0;
            $res[$i]['create_time'] = time();
            //必须用这这种方式转变后才能保存到数据库
            $list[] = $res[$i];
        }
        //实例化inrite_code表
        $inrite_code = D('inrite_code');
        //将$res数组的值以addAll的方式一次性赋值保存
        if ($inrite_code->addAll($list)) {
            $this->success('操作成功');
        } else {
            $this->error('操作失败');
        };
    }
	
	
	
	   //邀请码导出Excel
    public function goods_export() {
        $sql="SELECT i.*,m.username FROM lm_inrite_code i LEFT JOIN lm_manage m ON m.id=i.create_by WHERE i.is_delete=0";
        $goods_list = M()->query($sql);
        //print_r($goods_list);exit;
        $data = array();
        foreach ($goods_list as $k => $goods_info) {
            $data[$k][code] = $goods_info['code'];
            $data[$k][username] = $goods_info['username'];
            $data[$k][create_time] =date('Y-m-d H:i:s',$goods_info['create_time']);
        }
        //print_r($goods_list);
        //print_r($data);exit;

        foreach ($data as $field => $v) {
            if ($field == 'code') {
                $headArr[] = '邀请码';
            }

            if ($field == 'username') {
                $headArr[] = '管理员';
            }
            if ($field == 'create_time') {
                $headArr[] = '添加时间';
            }
        }

        $filename = "goods_list";

        $this->getExcel($filename, $headArr, $data);
    }

    private function getExcel($fileName, $headArr, $data) {
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Writer.Excel5");
        import("Org.Util.PHPExcel.IOFactory.php");

        $date = date("Y_m_d", time());
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        //print_r($headArr);exit;
        foreach ($headArr as $v) {
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();

        //print_r($data);exit;
        foreach ($data as $key => $rows) { //行写入
            $span = ord("A");
            foreach ($rows as $keyName => $value) {// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j . $column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);
        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }
	//后台首页列表显示数据
	 public function index(){
        $users=M("admin");
        $user=$users->select();
        $this->assign('user',$user);
        $this->display();
        
    }
	//一次性删除多条数据方法
    public function submit(){
        $getid=$_REQUEST['id'];//获取选择的复选框的值
        //dump($getid);exit;
		if (!$getid) $this->error('未选择记录') ;//没选择就提示信息
		$getids=implode(',',$getid);   
                //选择一个以上，就用,把值连接起来(1,2,3)这样		
		$id = is_array($getid)?$getids:$getid;
                //如果是数组，就把用,连接起来的值覆给$id,否则就覆获取到的没有,号连接起来的值
		
              
                $Result=M("admin")->execute('DELETE FROM db_admin where `id` IN ('.$id.')');
                //上面和下面的方式都行
//		$Result= M('admin')->where(array('id'=>array('IN', $id)))->delete();
		
		if($Result===false){
			$this->error('操作失败');
		}else{
		$this->success('删除成功',U('Demo/index'));
	        
		}
    }
?>