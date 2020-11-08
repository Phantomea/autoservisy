<?php

namespace Phantomea\Autoservis;

use Nette\Security\IAuthorizator;
use Nette\Security\Permission;
use Storm\Connection;

class Authorizator extends Permission implements IAuthorizator
{
	/**
	 * @var Connection
	 */
	private $storm;
	
	public function __construct(Connection $storm)
	{
		$this->storm = $storm;
		$this->addRole("guest");
		$this->deny();
	}
	
	function isAllowed($role = self::ALL, $resource = self::ALL, $privilege = self::ALL): bool
	{
		$this->checkRole($role);
	}
	
	private function checkRole(string $role)
	{
	
	}
}