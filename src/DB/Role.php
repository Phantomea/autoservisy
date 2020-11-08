<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_role","pk":{"lenght":255}}
 */
class Role extends Model
{
	/**
	 * @column{"type":"text"}
	 * @var string
	 */
	public $name;
}