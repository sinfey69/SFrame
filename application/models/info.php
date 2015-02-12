<?php
namespace application\models;
use \core\DbBase;
class info extends DbBase
{

	private $tableName = 'info';

	function __construct($dbName = 'trans')
	{
		parent::__construct($dbName);
	}
	
	public function addInfo($name, $content, $path)
	{
		$time = time();
		$sql = "INSERT INTO ".$this->tableName." (name, pic, content, addTime)";
		$sql .= " VALUES ('$name', '$path', '$content', $time)";
		if($this->dbo->exec($sql)!=FALSE)
		{
			return $this->dbo->lastInsertId();
		}
		return FALSE;
	}

	public function getList()
	{
		$sql = "SELECT id,name,pic,addTime,content from " . $this->tableName;
		return self::select($sql);
	}

	private function select($sql, $one = FALSE, $clumn = FALSE)
	{
		$dbh = $this->dbo->query($sql);
		$dbh->setFetchMode(\PDO::FETCH_ASSOC);
		if($clumn)
		{
			return $dbh->fetchColumn();
		}
		if($one)
		{
			return $dbh->fetch();
		}
		return $dbh->fetchAll();
	}
}