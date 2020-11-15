<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_carpart"}
 */
class CarPart extends Model
{
	/**
	 * @column
	 * @var string
	 */
	public $name;
	
	/**
	 * @column
	 * @var string
	 */
	public $ean = '';
}