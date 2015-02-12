<?php
namespace core;

class DbBase
{

	private static $connections = array();

	/**
	 *
	 * @var PDO
	 */
	protected $dbo;

	private $dbName;

	protected $sql;

	public function __construct($dbconf = 'default', $isConnet = TRUE)
	{
		if($dbconf === FALSE)
		{
			$dbconf = 'default';
		}
		$this->dbName = 'db_' . $dbconf;
		$this->dbo = NULL;
		if($isConnet)
		{
			$this->connect();
		}
	}

	public final function getDb()
	{
		return $this->dbo;
	}

	public final function getLastQuestSql()
	{
		return $this->sql;
	}

	public final function connect()
	{
		if(isset(\core\DbBase::$connections[$this->dbName]))
		{
			$this->dbo = \core\DbBase::$connections[$this->dbName];
			return;
		}
		$conf = new $this->dbName();
		$arribute = array(\PDO::ATTR_PERSISTENT => $conf->getPersistent(),\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);
		$this->dbo = new \PDO(
			$conf->getType() . ':host=' . $conf->getHost() . ';port=' . $conf->getPort() . ';dbname=' . $conf->getName(), 
			$conf->getUser(), $conf->getPassword(), $arribute);
		$this->dbo->query('set names ' . ($conf->getCharset()? $conf->getCharset() :'utf8'));
		\core\DbBase::$connections[$this->dbName] = $this->dbo;
	}

	public final function close()
	{
		$this->dbo = NULL;
	}

	public function __destruct()
	{
		$this->close();
	}
}
interface DbConfig
{

	public function getType();

	public function getHost();

	public function getName();

	public function getUser();

	public function getPassword();

	public function getPersistent();

	public function getCharset();

	public function getPort();
}

class DbConfigBase implements DbConfig
{

	protected $type;

	protected $host;

	protected $name;

	protected $user;

	protected $password;

	protected $persistent;

	protected $charset;

	protected $port = '3306';

	public final function getType()
	{
		return $this->type;
	}

	public final function getHost()
	{
		return $this->host;
	}

	public final function getName()
	{
		return $this->name;
	}

	public final function getUser()
	{
		return $this->user;
	}

	public final function getPassword()
	{
		return $this->password;
	}

	public final function getPersistent()
	{
		return $this->persistent;
	}

	public final function getCharset()
	{
		return $this->charset;
	}

	public final function getPort()
	{
		return $this->port;
	}
}
