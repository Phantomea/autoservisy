<?php

namespace Phantomea\Autoservis;


use Nette\Security\IIdentity;
use Phantomea\Autoservis\DB\User;

class Authenticator implements \Nette\Security\IAuthenticator
{
	use \Nette\SmartObject;
	
	private const PASSWORD_SALT = "rE42xxxlzphy55";
	
	/**
	 * @var \Storm\Connection
	 */
	protected $stm;
	
	/**
	 * @var \Nette\DI\Container
	 */
	protected $container;
	
	public function __construct(\Storm\Connection $stm, \Nette\DI\Container $container)
	{
		$this->stm = $stm;
		$this->container = $container;
	}
	
	static public function setCredentialTreatment($password): string
	{
		return sha1($password . str_repeat(self::PASSWORD_SALT, 10));
	}
	
	public static function passwordVerify($password, $hash): bool
	{
		return $password === $hash;
	}
	
	public function authenticate(array $credentials): IIdentity
	{
		[$userEmail, $password] = $credentials;
		
		$user = $this->stm->getRepository(User::class)->one(['email' => $companyEmail, 'authorized' => true]);
		
		if (!$user) {
			throw new Nette\Security\AuthenticationException('Účet s týmto e-mailom nebol neexistuje alebo bol zablokovaný');
		}
		
		if (!$user->isPasswordCorrect($password)) {
			throw new Nette\Security\AuthenticationException('Zadali ste zlé prihlasovacie údaje, uistite sa, že e-mail a heslo sú správne.');
		}
		
		$user->markAsLogged();
		
		return $user;
	}
}