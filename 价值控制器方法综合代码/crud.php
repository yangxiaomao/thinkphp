 <?php
	 //列表
		public function index() {
			$information = M("Information");
			$map['is_delete'] = 0;
			$sql = "SELECT i.*,m.username FROM lm_information i LEFT JOIN lm_manage m ON m.id=i.create_by WHERE i.is_delete=0";
			$list = M()->query($sql);
			$this->assign('list', $list);
			$this->display();
		}

		//老师添加
		public function add() {
			$this->display();
		}

		//编辑
		public function edit($id) {

			$information = M("Information");
			if (!$id) {
				$this->error('数据不存在');
			}
			$data = $information->find($id);
			$this->assign('data', $data);
			$this->display('add');
		}
	//添加和更新，判断$data['id'] > 0是修改，否则就添加
		public function update() {
			$information = M("Information");
			if (IS_POST) {
				$data = $information->create();
				if ($data['id'] > 0) {
					//修改图片上传时，判断这前是否有图片
					if ($_FILES['img_url']['tmp_name']) {
						//用unlink函数先删除原来的图片
						@unlink("./Uploads" . $data['img_url']);
						//之后再添加新图片
						$info = $this->upload();
						foreach ($info as $file) {
							$data['img_url'] = $file['savepath'] . $file['savename'];
						}
					}
					//获取服务器ip
					$data['lastloginip'] = get_client_ip();
					$data['lastlogintime'] = time();
					$information->save($data);
					$this->success('操作成功！', U('index'));
					die();
				} else {
					$info = $this->upload();
					foreach ($info as $file) {
						$data['img_url'] = $file['savepath'] . $file['savename'];
					}
					$data['reg_ip'] = get_client_ip();
					$data['create_time'] = time();
					$data['create_by'] = get_uid();
					$information->add($data);
					$this->success('操作成功！', U('index'));
					die();
				}
				$this->error('操作失败');
			} else {
				$this->error('错误来源');
			}
		}

		//删除文章
		public function del($id) {
			if ($id > 0) {
				$information = M("Information");
				$data['is_delete'] = 1;
				$map['id'] = $id;
				$information->where($map)->save($data);
				$this->success('操作成功');
			} else {
				$this->error('操作失败');
			}
		}
	?>