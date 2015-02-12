<?php
use \core\DbBase;
class trans_domain_auction extends DbBase
{
	private $tableName = 'trans_domain_auction';
	function __construct($dbName = 'trans')
	{
		parent::__construct($dbName);
	}

	public function getTransInfoForBid($auditListId)
	{
		$sql = "SELECT TransStatus,Seller,Buyer from " . $this->tableName;
		$sql .= " WHERE AuditListId=$auditListId ";
		return self::select($sql, TRUE);
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