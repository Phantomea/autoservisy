<?php

namespace Phantomea\Autoservis\DB;

use Nette\Security\IIdentity;
use Storm\Model;

/**
 * @table{"name":"autoservis_company","pk":{"length":255}}
 */
class Company extends Model
{
	use CompanyTrait;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $description;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $web;
	
	/**
	 * @var bool
	 * @column{"default":"0", "locale":true}
	 */
	public $hidden = false;
	
	/**
	 * @column{"type":"timestamp","default":"CURRENT_TIMESTAMP"}
	 * @var int
	 */
	public $registered;
	
	/**
	 * @relation{"Branch":":fk_company"}
	 * @var \Phantomea\Autoservis\DB\Branch[]
	 */
	public $branches;
	
	public function getName(): string
	{
		return $this->name;
	}
	
	public function getEmail(): string
	{
		return $this->email ?? '';
	}
	
	public function getPhone(): string
	{
		return $this->phone ?? '';
	}
	
	public function getClearPhone(): string
	{
		if ($this->phone) {
			if (\strpos($this->phone, ' ') !== false) {
				$arrayOfPhones = \explode(', ', $this->phone);
				
				return $arrayOfPhones[0];
			}
			
			return $this->phone;
		}
		
		return '';
	}
}