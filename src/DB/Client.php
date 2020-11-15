<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_client"}
 */
class Client extends Model
{
	use CompanyTrait;
	
	/**
	 * @var string
	 * @column{"type":"text"}
	 */
	public $note = '';
	
	/**
	 * @relation{"Branch": "fk_branch"}
	 * @constraint
	 * @column{"name": "fk_branch"}
	 * @var \Phantomea\Autoservis\DB\Branch
	 */
	public $branch;
	
	/**
	 * @relation{"ClientCar":":fk_client"}
	 * @var \Phantomea\Autoservis\DB\ClientCar[]
	 */
	public $cars;
}