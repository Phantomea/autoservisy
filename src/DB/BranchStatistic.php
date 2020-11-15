<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_branchstatistic"}
 */
class BranchStatistic extends Model
{
	
	/**
	 * @var int
	 * @column{"type":"int", "default": 0}
	 */
	public $view = 0;
	
	/**
	 * @var int
	 * @column{"type":"int", "default": 0}
	 */
	public $show = 0;
	
	/**
	 * @var int
	 * @column{"type":"int", "default": 0}
	 */
	public $phoneClicked = 0;
	
	/**
	 * @var \Nette\Utils\DateTime
	 * @column{"type":"datetime"}
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