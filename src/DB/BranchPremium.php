<?php

namespace  Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_branchPremium"}
 */
class BranchPremium extends Model
{
	/**
	 * @column{"name": "start", "type":"timestamp"}
	 * @var \Nette\Utils\DateTime
	 */
	public $start;
	
	/**
	 * @column{"name": "end", "type":"timestamp"}
	 * @var \Nette\Utils\DateTime
	 */
	public $end;
	
	/**
	 * @relation{"Branch": "fk_branch"}
	 * @constraint
	 * @column{"name": "fk_branch"}
	 * @var \Phantomea\Autoservis\DB\Branch
	 */
	public $branch;
}