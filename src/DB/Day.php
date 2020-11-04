<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_day"}
 */
class Day extends Model
{
	/**
	 * @column{"locale": true}
	 * @var string
	 */
	public $name = '';
	
	/**
	 * @column{"type": "tinyint", "default": 0}
	 * @var int
	 */
	public $order = 10;
}