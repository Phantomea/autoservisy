<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_clientcar"}
 */
class ClientCar extends Model
{
	/**
	 * @column
	 * @var string
	 */
	public $spz = '';
	
	/**
	 * @column
	 * @var string
	 */
	public $vin = '';
	
	/**
	 * @var string
	 * @column{"type":"text"}
	 */
	public $note = '';
	
	/**
	 * @relation{"CarModel": "fk_model"}
	 * @constraint
	 * @column{"name": "fk_model"}
	 */
	public $model;
	
	/**
	 * @relation{"Client": "fk_client"}
	 * @constraint
	 * @column{"name": "fk_client"}
	 * @var \Phantomea\Autoservis\DB\Client
	 */
	public $client;
}