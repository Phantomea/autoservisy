<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_carbrand"}
 */
class CarBrand extends Model
{
	/**
	 * @column
	 * @var string
	 */
	public $name;
}