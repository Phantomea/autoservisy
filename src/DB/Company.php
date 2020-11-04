<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_company","pk":{"length":255}}
 */
class Company extends Model
{
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $owner;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $name;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $clearName;
	
	/**
	 * @column{"type": "int", "nullable": true}
	 * @var int
	 */
	public $orsrId;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $description;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $ico;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $dic;
	
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $address;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $web;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $email;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $phone;
	
	/**
	 * @var bool
	 * @column{"default":"0", "locale":true}
	 */
	public $hidden = false;
	
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