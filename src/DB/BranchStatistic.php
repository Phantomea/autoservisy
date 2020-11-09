<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_branchstatistic"}
 */
class BranchStatistic extends Model
{
	public const TYPE = [
		'view' => 'view',
		'emailSend' => 'emailSend',
		'show' => 'show',
		'phoneClicked' => 'phoneClicked',
	];
	
	/**
	 * @var int
	 * @column{"type":"int"}
	 */
	public $amount;
	
	/**
	 * @var int
	 * @column{"type":"int"}
	 */
	public $view = 0;
	
	/**
	 * @var int
	 * @column{"type":"int"}
	 */
	public $emailSend = 0;
	
	/**
	 * @var int
	 * @column{"type":"int"}
	 */
	public $show = 0;
	
	/**
	 * @var int
	 * @column{"type":"int"}
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