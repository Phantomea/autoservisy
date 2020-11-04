<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_city"}
 */
class City extends Model
{
	/**
	 * @column
	 * @var string
	 */
	public $name;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $image = '';
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $latitude = null;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $longitude = null;
	
	/**
	 * @column{"type": "int", "default": 100}
	 * @var bool
	 */
	public $priority;
	
	/**
	 * @var bool
	 * @column{"default":"0", "locale":true}
	 */
	public $hidden = false;
	
	public function getName(): string
	{
		return $this->name;
	}
	
	public function getImage(): string
	{
		return $this->image;
	}
	
	public function getEncodedName(): string
	{
		return \urlencode($this->name);
	}
}