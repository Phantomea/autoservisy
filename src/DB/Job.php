<?php

namespace Phantomea\Autoservis\DB;

use Nette\Utils\DateTime;
use Nette\Utils\Random;
use Nette\Utils\Strings;
use Storm\Collection;
use Storm\Model;

/**
 * @table{"name":"autoservis_job"}
 */
class Job extends Model
{
	public const PATTERN = '00000000001';
	
	/**
	 * @column
	 * @var string
	 */
	public $name;
	
	/**
	 * @column
	 * @var string
	 */
	public $number;
	
	/**
	 * @column{"type":"text","nullable":true}
	 * @var string
	 */
	public $note;
	
	/**
	 * @column{"type":"datetime","default":"CURRENT_TIMESTAMP"}
	 * @var \Nette\Utils\DateTime
	 */
	public $created;
	
	/**
	 * @column{"type":"datetime"}
	 * @var \Nette\Utils\DateTime
	 */
	public $start;
	
	/**
	 * @column{"type":"datetime","nullable":true}
	 * @var \Nette\Utils\DateTime
	 */
	public $end;
	
	/**
	 * @relation{"ClientCar": "fk_car"}
	 * @constraint
	 * @column{"name": "fk_car", "nullable":true}
	 */
	public $car;
	
	/**
	 * @relation{"Branch": "fk_branch"}
	 * @constraint
	 * @column{"name": "fk_branch"}
	 * @var \Phantomea\Autoservis\DB\Branch
	 */
	public $branch;
	
	public function setGeneratedNumber(int $numberOfExistingJobs): void
	{
		$numberOfExistingJobs++;
		$numberOfJobsString = \strlen((string) $numberOfExistingJobs);
		$generatedNumber = (new DateTime())->format('Y') . (\substr(self::PATTERN, 0, -$numberOfJobsString) . $numberOfExistingJobs);
		
		$this->number = $generatedNumber;
	}
}