<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_carmodel"}
 */
class CarModel extends Model
{
	/**
	 * @column
	 * @var string
	 */
	public $name;
	
	/**
	 * @relation{"CarBrand": "fk_brand"}
	 * @constraint
	 * @column{"name": "fk_brand"}
	 * @var \Phantomea\Autoservis\DB\CarBrand
	 */
	public $brand;
}