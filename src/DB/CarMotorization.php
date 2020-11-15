<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_carmotorization"}
 */
class CarMotorization extends Model
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