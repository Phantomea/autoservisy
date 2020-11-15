<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_carjob"}
 */
class CarJob extends Model
{
	/**
	 * @column
	 * @var string
	 */
	public $name;
	
	/**
	 * @column{"type":"text"}
	 * @var string
	 */
	public $note;
	
	/**
	 * @column{"type":"datetime","default":"CURRENT_TIMESTAMP"}
	 * @var \Nette\Utils\DateTime
	 */
	public $created;
	
	/**
	 * @var
	 */
	public $carParts;
}