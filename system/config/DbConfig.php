<?php
use \core\DbConfigBase;
class db_trans extends DbConfigBase
{

	public function __construct()
	{
		$this->type = 'mysql';
		$this->host = '192.168.10.216';
		$this->user = 'php';
		$this->password = 'enamephp';
		$this->name = 'ename_trans';
		$this->persistent = FALSE;
		$this->charset = 'utf8';
	}
}
class db_qiangzhu extends DbConfigBase
{

	public function __construct()
	{
		$this->type = 'mysql';
		$this->host = '192.168.10.216';
		$this->user = 'php';
		$this->password = 'enamephp';
		$this->name = 'ename_qz';
		$this->persistent = FALSE;
		$this->charset = 'utf8';
	}
}
class db_escrow extends DbConfigBase
{

	public function __construct()
	{
		$this->type = 'mysql';
		$this->host = '192.168.10.216';
		$this->user = 'php';
		$this->password = 'enamephp';
		$this->name = 'ename_escrow';
		$this->persistent = FALSE;
		$this->charset = 'utf8';
	}
}

?>
