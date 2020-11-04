<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_carBody"}
 */
class CarBody extends Model
{
	/**
	 * @column
	 * @var string
	 */
	public $name;
	
	/**
	 * @relation{"CarModel": "fk_model"}
	 * @constraint
	 * @column{"name": "fk_model"}
	 * @var \Phantomea\Autoservis\DB\CarModel
	 */
	public $model;
}