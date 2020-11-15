<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_carcheck"}
 */
class CarCheck extends Model
{
	/**
	 * @column
	 * @var int
	 */
	public $clock;
	
	/**
	 * @column{"type":"datetime","default":"CURRENT_TIMESTAMP"}
	 * @var \Nette\Utils\DateTime
	 */
	public $created;
	
	/**
	 * @relation{"ClientCar": "fk_car"}
	 * @constraint
	 * @column{"name": "fk_car"}
	 * @var \Phantomea\Autoservis\DB\ClientCar
	 */
	public $car;
}