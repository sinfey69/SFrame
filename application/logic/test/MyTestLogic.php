<?php
namespace application\logic\mytest;

class MyTest
{
	public function __construct()
	{
	}
	
	public function comment(\Controller $ctrl)
	{
		$name = $ctrl->input->filter('name', 'POST', '', 'string');
		$content = $ctrl->input->filter('content', 'POST', '', 'string');
		$path = $this->upload();
		//写入数据库
		$ctrl->loader->model('info');
		$model = new \application\models\info();
		if($model->addInfo($name, $content, $path))
		{
			\CommonPage::successPage('留言成功');
		}
		else 
		{
			throw new \Exception('留言失败');
		}
	}
	
	public function getCommentList( \Controller $ctrl)
	{
		$username = $ctrl->input->filter(0, 'SF', '', 'string');
		$msg = $ctrl->input->filter(1, 'SF', '', 'string');
		$ctrl->loader->model('info');
		$model = new \application\models\info();
		$data = $model->getList();
		return array('list'=>$data, 'hello'=>$username.$msg);
	}

	public function upload()
	{
		$picConf = config('pic');
		// 图片过滤，像素小于30x30，不能上传
		$tmpImg = getimagesize($_FILES['pic']['tmp_name']);
		if($tmpImg[0] < $picConf['minwidth'] && $tmpImg[1] < $picConf['minheight'])
		{
			throw new \Exception("图片必须大于".$picConf['minwidth']."x".$picConf['minheight']."像素，请选择适当的图片上传");
		}
		//检查图片格式
		$type = $this->getImgType($tmpImg[2]);
		if(in_array($type, $picConf['type'])===false)
		{
			throw new \Exception("图片格式只支持".implode('|', $picConf['type']));
		}
		//创建上传目录
		$filePath = $picConf['uploaddir'];
		if(!file_exists($filePath))
		{
			$this->create_folders($filePath);
		}
		$path = $filePath . "/" . time().'.'.$type;
		if(move_uploaded_file($_FILES['pic']['tmp_name'], $path))
		{
			return $path;
		}
		else 
		{
			throw new \Exception("图片上传失败");
		}
	}
	
	/**
	 * 创建文件夹 2012-05-10	Qxh	Add
	 */
	public function create_folders($dir)
	{
		return is_dir($dir) or ($this->create_folders(dirname($dir)) and mkdir($dir, 0777));
	}
	
	/**
	 * 获取图片类型
	 * @param unknown $imgTypeCode
	 * @return string
	 */
	public function getImgType($imgTypeCode)
	{
		switch($imgTypeCode)
		{
			case 1:
				return 'gif';
				break;
			case 2:
				return 'jpg';
				break;
			case 3:
				return 'png';
				break;
			default:
				return 'jpg';
		}
	}
}