<?php

namespace Phantomea\Autoservis\DB;

trait CompanyTrait
{
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $name;
	
	/**
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
}