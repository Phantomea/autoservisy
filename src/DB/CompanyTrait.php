<?php

namespace Phantomea\Autoservis\DB;

trait CompanyTrait
{
	/**
	 * If client is company, this prop is it's name
	 * @column{"nullable": true}
	 * @var string
	 */
	public $name;
	
	/**
	 * Contact person
	 * @column{"nullable": true}
	 * @var string
	 */
	public $owner = '';
	
	/**
	 * @column{"type":"int", "nullable":true}
	 * @var int
	 */
	public $ico;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $dic = '';
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $email;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $address;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $phone;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $web;
	
	public function isCompany(): bool
	{
		return (bool) $this->ico;
	}
}