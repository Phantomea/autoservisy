<?php

namespace Phantomea\Autoservis\DB;

use Lqd\Security\DB\UserTrait;
use Nette\Security\IIdentity;
use Phantomea\Autoservis\Authenticator;
use Storm\Model;

/**
 * @table{"name":"autoservis_user","pk":{"lenght":255}}
 */
class User extends Model implements IIdentity
{
	
	/**
	 * @column
	 * @var string
	 */
	public $fullName = '';
	
	/**
	 * @column
	 * @var string
	 */
	public $email = '';
	
	/**
	 * @column{"type":"timestamp","default":"CURRENT_TIMESTAMP"}
	 * @var int
	 */
	public $registered;
	
	/**
	 * @var boolean
	 * @column{"default":1}
	 */
	public $authorized = true;
	
	/**
	 * @var ?\Phantomea\Autoservis\DB\Company
	 * @relation{"Company":"fk_company"}
	 * @constraint
	 * @column{"name":"fk_company","nullable": true}
	 */
	public $company = null;
	
	/**
	 * @relation{"Role":"fk_role"}
	 * @constraint
	 * @column{"name":"fk_role","nullable":true}
	 * @var \Phantomea\Autoservis\DB\Role
	 */
	public $role = null;
	
	function getId(): string
	{
		return $this->getPK();
	}
	
	public function getRoles(): array
	{
		$this->role ? [$this->fk_role] : [];
	}
	
	public function isPasswordCorrect(string $password): bool
	{
		return Authenticator::passwordVerify(Authenticator::setCredentialTreatment($password), $this->password);
	}
	
	public function markAsLogged(): void
	{
		$this->tsLastlogin = new \Nette\Utils\DateTime();
		$this->update();
	}
}