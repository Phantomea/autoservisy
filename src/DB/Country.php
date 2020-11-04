<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_country"}
 */
class Country extends Model
{
	/**
	 * @column
	 * @var string
	 */
	public $name;
}