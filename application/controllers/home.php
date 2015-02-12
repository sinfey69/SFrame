<?php
class home extends Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		try
		{
			require_once APP.'logic/test/MyTestLogic.php';
			$logic = new \application\logic\mytest\MyTest();
			if($_POST)
			{
				$logic->comment($this);
			}
			else 
			{
				$data = $logic->getCommentList($this);
				$data['title'] = '框架测试demo页';
				$this->loader->view('common/header', $data);
				$this->loader->view('test', $data);
			}
		}
		catch (Exception $e)
		{
			CommonPage::errorPage($e->getMessage());
		}
	}

	public function hello()
	{
		try 
		{
			throw new Exception('test throw error');
			echo config('indexPage');
			echo 'hello world!';
		}
		catch (Exception $e)
		{
			CommonPage::errorPage($e->getMessage());
		}
	}
	
	public function test()
	{
		try 
		{
			setLog(DEFAULT_LOG, array('this a test page begin', array('aaa')), 'TRUE');
			$name = $this->input->filter('name', 'SF', array('isNumber'=>'必须数字'), array('string'));
			$data = array('title'=>'this is a test page title', 'name'=>$name);
			$this->loader->view('common/header', $data);
			$this->loader->view('home', $data);
		}
		catch (Exception $e)
		{
			CommonPage::errorPage($e->getMessage());
		}
	}
	
	public function testmodel()
	{
		var_dump(siteUrl());
		var_dump(baseUrl());
		$this->loader->model('trans_domain_auction');
		$TDAsdk = new trans_domain_auction();
		$data = $TDAsdk->getTransInfoForBid(28523165, 1, 574411);
		var_dump($data);
	}
}