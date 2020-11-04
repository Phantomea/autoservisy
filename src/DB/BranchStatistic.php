<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_branchStatistic"}
 */
class BranchStatistic extends Model
{
	public const TYPE = ['view', 'emailSend', 'show', 'phoneClicked'];
	
	/**
	 * @var int
	 * @column{"type":"int"}
	 */
	public $amount;
	
	/**
	 * @var string
	 * @column{"type":"enum","length":"'view','emailSend','show','phoneClicked'"}
	 */
	public $type;
	
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