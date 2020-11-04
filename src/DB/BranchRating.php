<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_branchRating"}
 */
class BranchRating extends Model
{
	/**
	 * @var string
	 * @column
	 */
	public $name;
	
	/**
	 * @var string
	 * @column{"type":"text"}
	 */
	public $text;
	
	/**
	 * @var int
	 * @column{"type":"tinyint", "default": 0}
	 */
	public $communication = 0;
	
	/**
	 * @var int
	 * @column{"type":"tinyint", "default": 0}
	 */
	public $price;
	
	/**
	 * @var int
	 * @column{"type":"tinyint", "default": 0}
	 */
	public $expertise;
	
	/**
	 * @var \Nette\Utils\DateTime
	 * @column{"type":"datetime","default":"CURRENT_TIMESTAMP"}
	 */
	public $created;
	
	/**
	 * @relation{"Branch": "fk_branch"}
	 * @constraint
	 * @column{"name": "fk_branch"}
	 * @var \Phantomea\Autoservis\DB\Branch
	 */
	public $branch;
}